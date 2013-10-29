<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 2:44 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventsManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventManager;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSDomEventsManager extends CympelService implements iDynamicJSDomEventsManager
{
    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var iFinder
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
     * @var iDynamicJSDomEventManager
     */
    protected $dynamicJDomEventManager;

    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iDynamicJSDomEventManager $dynamicJDomEventManager
     */
    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iDynamicJSDomEventManager $dynamicJDomEventManager)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->dynamicJDomEventManager = $dynamicJDomEventManager;
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
        return 'DynamicJSDomEventsManager';
    }

    /**
     * @param array $eventsArray
     * @return iDynamicJSDomEvents
     */
    public function createFromArray($eventsArray)
    {
        $events = $this->creator->create('DynamicJSDomEvents');
        $eventsCollection = new ArrayCollection();
        foreach($eventsArray as $key => $value) {
            $eventsCollection[$key] = $this->dynamicJDomEventManager->getCreator()->create('DynamicJSDomEvent');
            $eventsCollection[$key]->setEventName($value);
            $eventsCollection[$key]->setParentDynamicJDomEvents($events);
        }
        $events->setEvents($eventsCollection);
        return $events;
    }
}