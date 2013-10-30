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
use Cympel\Bundle\AnalyticsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;

class DynamicJSDomEventManager extends CympelService implements iDynamicJSDomEventManager
{
    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var \Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventFinder
     */
    protected $finder;

    /**
     * @var iPersister
     */
    protected $persister;

    /**
     * @var iRemover
     */
    protected $remover;


    /**
     * @param iCreator $creator
     * @param iDynamicJSDomEventFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     */
    public function __construct(iCreator $creator, iDynamicJSDomEventFinder $finder, iPersister $persister, iRemover $remover)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
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

    /**
     * @return iPersister
     */
    public function getPersister()
    {
        return $this->persister;
    }

    /**
     * @return iRemover
     */
    public function getRemover()
    {
        return $this->remover;
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