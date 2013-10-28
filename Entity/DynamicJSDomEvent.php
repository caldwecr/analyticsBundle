<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:49 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DynamicJSDomEvent
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSDomEvent")
 */
class DynamicJSDomEvent extends CympelType implements iDynamicJSDomEvent
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    protected $eventName;

    /**
     * @var iDynamicJSDomEvents
     * @ORM\ManyToOne(targetEntity="DynamicJSDomEvents", inversedBy="events", cascade={"persist"})
     * @ORM\JoinColumn(name="parentDynamicJSDomEventsId", referencedColumnName="id")
     */
    protected $parentDynamicJSDomEvents;

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEvent';
    }

    /**
     * @param string $eventName
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents $parentDynamicJSDomEvents
     */
    public function setParentDynamicJSDomEvents($parentDynamicJSDomEvents)
    {
        $this->parentDynamicJSDomEvents = $parentDynamicJSDomEvents;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents
     */
    public function getParentDynamicJSDomEvents()
    {
        return $this->parentDynamicJSDomEvents;
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        return self::areEqual($this, $rightSide);
    }
}