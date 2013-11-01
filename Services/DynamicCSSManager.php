<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManagerExtensionService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;

class DynamicCSSManager extends RoutedTrackingToolManager
{
    protected $doctrine;
    protected $trackingToolRemover;
    protected $router;
    protected $trackingToolValidator;
    protected $trackerManager;
    protected $emName;
    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var iFinder
     */
    protected $finder;

    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        parent::__construct($creator, $finder, $persister, $remover, $validator, $extender);
        $this->doctrine = $extender->getDoctrine();
        $this->trackingToolRemover = $this->extender->getTrackingToolRemover();
        $this->trackingToolValidator = $this->extender->getTrackingToolValidator();
        $this->router = $this->extender->getRouter();
        $this->trackerManager = $this->extender->getTrackerManager();
        $this->emName = $this->extender->getEntityManagerName();

    }
// need doctrine, trackingToolRemover, trackingToolValidator, router, trackerManager, entityManagerName, existing extension service

    /*public function __construct(iFinder $finder, iCreator $creator, $doctrine, iTrackingToolRemover $trackingToolRemover, iTrackingToolValidator $trackingToolValidator, $router, TrackerManager $trackerManager, $entityManagerName, iTrackingToolManagerExtensionService $extensionService = null)
    {
        $this->doctrine = $doctrine;
        $this->trackingToolRemover = $trackingToolRemover;
        $this->trackingToolValidator = $trackingToolValidator;
        $this->router = $router;
        $this->trackerManager = $trackerManager;
        $this->emName = $entityManagerName;
        $this->setServiceExtension($extensionService);
        $this->creator = $creator;
        $this->finder = $finder;
    }*/

    /**
     * @param string $classAlias
     * @param array $ids - an array of DOM id's that the stylesheet should include trackers for
     * @param string $pseudo - which pseudo class the stylesheet should bind its tracking to
     * @return string
     *
     * The method returns a URI to the created stylesheet
     */
    public function generateOneTimeStylesheet($classAlias, $ids, $pseudo)
    {
        $properties = new DynamicCSSPropertySet();
        $properties->setIds($this->extender->getDynamicCSSDomIdArrayCollectionManager()->create($ids));
        $properties->setPseudo($pseudo);
        return $this->generate($classAlias, $properties, $this->getTrackerManager()->create());
    }

    /**
     * @return TrackerManager
     */
    protected function getTrackerManager()
    {
        return $this->trackerManager;
    }

    /**
     * @param TrackerManager $trackerManager
     * @return void
     */
    protected function setTrackerManager(TrackerManager $trackerManager)
    {
        $this->trackerManager = $trackerManager;
    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @return array
     *
     * This method is included so that the url property of the DynamicCSSDomId class can be populated even though this field is not persisted to the database
     *  and thus accessed via the twig template at render time.
     */
    public function getDynamicCSSDomIds(DynamicCSS $dynamicCSS)
    {
        $ids = $dynamicCSS->getDynamicCSSDomIds()->toArray();
        foreach ($ids as $key => $value) {
            $value->setUrl(
                $this->router->generate('dynamicCSSImageFile',
                    array(
                        'key' => $dynamicCSS->getId(),
                        'domIdValue' => $value->getDomIdValue(),
                    ),
                    URLGeneratorInterface::ABSOLUTE_PATH
                )
            );
        }
        return $ids;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSManager';
    }

    /**
     * @param DynamicCSS $dynamicCSS
     */
    public function removeOneTimeStylesheet(DynamicCSS $dynamicCSS)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($dynamicCSS);
        $em->flush();
    }



    /**
     * @param string $classAlias
     * @param $id
     * @return DynamicCSS
     *
     */
    public function findOneTimeStylesheetById($classAlias, $id)
    {
        return $this->getFinder()->findOneByIdAndClassAlias($id, $classAlias);
    }

    /**
     * @return iPropertySet
     */
    protected function createPropertySet()
    {
        return new DynamicCSSPropertySet();
    }

    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomIdArrayCollection|iPropertySet
     *
     * The purpose of this method is to allow changes to the properties based on the tool's initialization
     * that would have otherwise been impossible prior to the tool's initialization
     * This is necessary for DynamicCSS tools so that the DomIds can be bound to the tool
     */
    protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool)
    {
        return $this->attachToolToProperties($properties, $tool);
    }

    /**
     * @param DynamicCSSPropertySet $properties
     * @param iTrackingTool $tool
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomIdArrayCollection
     */
    private function attachToolToProperties(DynamicCSSPropertySet $properties, iTrackingTool $tool)
    {
        /**
         * This is necessary because the DynamicCSSDomIdArrayCollection needs to associate each DynamicCSSDomId with the tool
         */
        $dynamicCSSDomIdArrayCollection = $properties->getIds();
        $this->extender->getDynamicCSSDomIdArrayCollectionManager()->attachToolToDynamicCSSDomIds($dynamicCSSDomIdArrayCollection, $tool);
        return $properties;
    }

    /**
     * @return Object - the doctrine service
     */
    protected function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @param $doctrine
     * @return void
     */
    protected function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return string
     */
    protected function getEmName()
    {
        return $this->emName;
    }

    /**
     * @param string $emName
     * @return void
     */
    protected function setEmName($emName)
    {
        $this->emName = $emName;
    }

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return 'CympelAnalyticsBundle:DynamicCSS';
    }

    /**
     * @return string
     */
    protected function getRouteName()
    {
        return 'dynamicCSS';
    }

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    protected function getRoutingArray(iTrackingTool $tool)
    {
        return array(
            'key' => $tool->getId(),
        );
    }

    /**
     * @return iTrackingToolValidator
     */
    protected function getTrackingToolValidator()
    {
        return $this->trackingToolValidator;
    }

    /**
     * @param iTrackingToolValidator $trackingToolValidator
     * @return void
     */
    protected function setTrackingToolValidator(iTrackingToolValidator $trackingToolValidator)
    {
        $this->trackingToolValidator = $trackingToolValidator;
    }

    /**
     * @return iTrackingToolRemover
     */
    protected function getTrackingToolRemover()
    {
        return $this->trackingToolRemover;
    }

    /**
     * @param iTrackingToolRemover $trackingToolRemover
     * @return void
     */
    protected function setTrackingToolRemover(iTrackingToolRemover $trackingToolRemover)
    {
        $this->trackingToolRemover = $trackingToolRemover;
    }

    /**
     * @return iCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return iFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }


}