<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 9:54 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSets;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;
use Cympel\Bundle\AnalyticsBundle\Services\CympelManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorDomEventManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorDomEventFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Config\Definition\Exception\Exception;

class DynamicJSSelectorDomEventManager extends CympelManager implements iDynamicJSSelectorDomEventManager
{
    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iValidator $validator
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        $this->creator = $creator;
        $this->forceTypedFinder($finder);
        $this->persister = $persister;
        $this->remover = $remover;
        $this->validator = $validator;
        $this->extender = $extender;
    }

    /**
     * @param iDynamicJSSelectorDomEventFinder $finder
     */
    private function forceTypedFinder(iDynamicJSSelectorDomEventFinder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param iDynamicJSSelector $selector
     * @param iDynamicJSDomEvent $domEvent
     * @param string $json
     * @param string $classAlias
     * @return iDynamicJSSelectorDomEvent
     */
    public function captureClientDataSet(iDynamicJSSelector $selector, iDynamicJSDomEvent $domEvent, $json, $classAlias)
    {
        // Check to see if a selectorDomEvent already exists for the key, selector, and domEvent if so get it, if not create it
        $selectorDomEvent = $this->findOrCreateDynamicJSSelectorDomEvent($selector, $domEvent, $classAlias);

        // Add a clientDataSet based on the $json argument
        $clientDataSets = $selectorDomEvent->getClientDataSets();
        if(!$clientDataSets) {
            $clientDataSets = $this->getCreator()->create('DynamicJSSelectorDomEventClientDataSets');
        }
        $dataSetCollection = $clientDataSets->getDataSets();
        $dataSetArray = array();
        if($dataSetCollection) {
            $dataSetArray = $dataSetCollection->toArray();
        }
        $dataSet = $this->getCreator()->create('DynamicJSSelectorDomEventClientDataSet');
        $decoded = json_decode($json);
        $x = $decoded->clientX;
        $y = $decoded->clientY;
        $classes = null; //@todo handle parsing classes
        $domElementId = $decoded->id;
        $clientEventType = $decoded->eventType;
        $clientOuterHTML = $decoded->outerHTML;

        $dataSet->setClientX($x);
        $dataSet->setClientY($y);
        //$dataSet->setClientClasses($classes);
        $dataSet->setParentDataSets($clientDataSets);
        $dataSet->setClientDomElementId($domElementId);
        $dataSet->setClientEventType($clientEventType);
        $dataSet->setClientOuterHTML($clientOuterHTML);

        $dataSetArray[] = $dataSet;

        $clientDataSets->setDataSets(new ArrayCollection($dataSetArray));
        $clientDataSets->setSelectorDomEvent($selectorDomEvent);
        $selectorDomEvent->setClientDataSets($clientDataSets);
        // Persist the selectorDomEvent
        $this->getPersister()->persist($selectorDomEvent);
        // Return the selectorDomEvent
        return $selectorDomEvent;
    }

    /**
     * @param iDynamicJSSelector $selector
     * @param iDynamicJSDomEvent $domEvent
     * @param string $classAlias
     * @return iDynamicJSSelectorDomEvent
     */
    public function findOrCreateDynamicJSSelectorDomEvent(iDynamicJSSelector $selector, iDynamicJSDomEvent $domEvent, $classAlias)
    {
        $found = $this->getFinder()->findOneBySelectorAndDomEvent($selector, $domEvent, $classAlias);
        if(!$found) {
            $found = $this->getCreator()->create('DynamicJSSelectorDomEvent');
            $found->setSelector($selector);
            $found->setDomEvent($domEvent);
        }
        return $found;
    }

    /**
     * @return iDynamicJSSelectorDomEventFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }

}