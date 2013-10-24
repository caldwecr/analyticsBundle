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
use Cympel\Bundle\AnalyticsBundle\Entity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DynamicCSSManager extends RoutedTrackingToolManager
{
    protected $doctrine;

    protected $router;

    protected $validator;

    protected $trackerManager;

    protected $emName;

    /**
     * @var DynamicCSSServiceExtension
     */
    protected $dynamicCSSServiceExtension;

    /**
     * @param $doctrine
     * @param $validator
     * @param $router
     * @param TrackerManager $trackerManager
     * @param $entityManagerName
     * @param iTrackingToolManagerExtensionService $extensionService
     */
    public function __construct($doctrine, $validator, $router, TrackerManager $trackerManager, $entityManagerName, iTrackingToolManagerExtensionService $extensionService = null)
    {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
        $this->router = $router;
        $this->trackerManager = $trackerManager;
        $this->emName = $entityManagerName;
        $this->setServiceExtension($extensionService);
    }

    private function setServiceExtension(DynamicCSSServiceExtension $extension)
    {
        $this->dynamicCSSServiceExtension = $extension;
    }

    /**
     * @param array $ids - an array of DOM id's that the stylesheet should include trackers for
     * @param string $pseudo - which pseudo class the stylesheet should bind its tracking to
     * @return string
     *
     * The method returns a URI to the created stylesheet
     */
    public function generateOneTimeStylesheet($ids, $pseudo)
    {
        $tracker = $this->trackerManager->create();
        $dCSS = $this->create($tracker);
        $properties = new DynamicCSSPropertySet();
        $properties->setPseudo($pseudo);
        $dCSSDomIds = $this->dynamicCSSServiceExtension->getDynamicCSSDomIdArrayCollectionManager()->create($dCSS, $ids);
        $properties->setIds($dCSSDomIds);
        $properties->pushTo($dCSS);
        $this->persist($dCSS);
        return $this->generateUrl($dCSS, UrlGeneratorInterface::ABSOLUTE_PATH);
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
     * @return Object -- the router service
     */
    protected function getRouter()
    {
        return $this->router;
    }

    /**
     * @param $router
     * @return void
     */
    protected function setRouter($router)
    {
        $this->router = $router;
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
     * @param DynamicCSS $dynamicCSS
     * @return array
     *
     * This method is included so that the url property of the DynamicCSSDomId class can be populated even though this field is not persisted to the database
     *  and thus accessed via the twig template at render time.
     */
    public function getDynamicCSSDomIds(DynamicCSS $dynamicCSS)
    {
        $ids = $dynamicCSS->getDynamicCSSDomIds()->toArray();
        foreach($ids as $key => $value) {
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
     * @param $id
     * @return DynamicCSS
     *
     */
    public function findOneTimeStylesheetById($id)
    {
        return $this->findOneById($id);
    }

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return 'CympelAnalyticsBundle:DynamicCSS';
    }

    /**
     * @return iPropertySet
     */
    protected function createPropertySet()
    {
        return new DynamicCSSPropertySet();
    }


    /**
     * @param $id
     * @return mixed
     *
     * This method is invoked by the Default Controller to render a DynamicCSS
     */
    public function renderDCSSById($id)
    {
        $toReturn = $this->findOneTimeStylesheetById($id);
        $toReturn->setRendered(time());
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($toReturn);
        $em->flush();
        return $toReturn;
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
     * @return iTrackingTool
     */
    protected function createTrackingTool()
    {
        return new DynamicCSS();
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
     * @return Object - the validator service
     */
    protected function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param $validator
     * @return void
     */
    protected function setValidator($validator)
    {
        $this->validator = $validator;
    }


}