<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 3:03 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Services\CympelManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;

class DynamicJSDomEventManager extends CympelManager implements iDynamicJSDomEventManager
{
    /**
     * @var iDynamicJSDomEventFinder
     *
     * Overrides Manager's Finder's base type
     */
    protected $finder;

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
        $this->construtorHelperChecksTypedFinder($finder);
        $this->persister = $persister;
        $this->remover = $remover;
        $this->validator = $validator;
        $this->extender = $extender;
    }

    /**
     * @param iDynamicJSDomEventFinder $finder
     */
    private function construtorHelperChecksTypedFinder(iDynamicJSDomEventFinder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param $eventKey
     * @param iDynamicJSSelector $selector
     * @param $classAlias
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent
     */
    public function findOneByEventKeyAndSelector($eventKey, iDynamicJSSelector $selector, $classAlias)
    {
        // Find the dynamicJS for the selector
        $dynamicJSSelectors = $selector->getParentSelectors();
        $dynamicJ = $dynamicJSSelectors->getDynamicJ();
        // Find the events for the dynamicJS
        $domEvents = $dynamicJ->getEvents();
        // Find the event from the events that matches the key - could more than one match?
        $domEvent = $this->finder->findOneEventByEventsAndEventName($domEvents, $eventKey, $classAlias);
        return $domEvent;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEventManager';
    }

}