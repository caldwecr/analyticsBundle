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
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException;
use Cympel\Bundle\AnalyticsBundle\Entity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DynamicCSSManager extends TrackingToolManager
{

    protected $router;

    protected $validator;

    /**
     * @var DynamicCSSDomIdManager
     */
    protected $dynamicCSSDomIdManager;

    public function __construct($doctrine, $router, DynamicCSSDomIdManager $dynamicCSSDomIdManager, $entityManagerName, TrackerManager $trackerManager, $validator)
    {
        $this->doctrine = $doctrine;
        $this->router = $router;
        $this->dynamicCSSDomIdManager = $dynamicCSSDomIdManager;
        $this->emName = $entityManagerName;
        $this->trackerManager = $trackerManager;
        $this->validator = $validator;
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
        $dCSS = new DynamicCSS();
        $dCSSDomIds = new ArrayCollection();
        foreach($ids as $key => $value) {
            $dCSSDomIds[$key] = $this->dynamicCSSDomIdManager->create();
            $dCSSDomIds[$key]->setDynamicCSS($dCSS);
            $dCSSDomIds[$key]->setDomIdValue($value);
        }
        $dCSS->setDynamicCSSDomIds($dCSSDomIds);
        $dCSS->setPseudo($pseudo);
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($dCSS);
        $em->flush();
        return $this->router->generate('dynamicCSS',
            array(
                'key' => $dCSS->getId(),
            ),
            URLGeneratorInterface::ABSOLUTE_PATH
        );
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
     * @param iTrackingTool $tool
     * @param iPropertySet $properties
     * @return iTrackingTool
     */
    public function setProperties(iTrackingTool $tool, iPropertySet $properties)
    {
        return $properties->pushTo($tool);
    }

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * This method must return all bindings on the tracking tool
     */
    public function getProperties(iTrackingTool $tool)
    {
        $p = new DynamicCSSPropertySet();
        return $p->pullFrom($tool);
    }


    /**
     * @param iTrackingTool $tool
     * @return bool
     *
     * This method should cause the tool's properties to be validated
     */
    public function validate(iTrackingTool $tool)
    {
        if(!$tool->hasValidationConstraints()) {
            return true;
        }
        $errors = $this->validator->validate($tool);
        if(count($errors) > 0) {
            return false;
        }
        return true;
    }


}