<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:55 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DynamicJSDomEvents
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSDomEvents")
 */
class DynamicJSDomEvents extends CympelType implements iDynamicJSDomEvents
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var DynamicJS
     * @ORM\OneToOne(targetEntity="DynamicJS", inversedBy="events", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="dynamicJsId", referencedColumnName="id")
     */
    protected $dynamicJ;

    /**
     * @var ArrayCollection of DynamicJSDomEvent objects
     * @ORM\OneToMany(targetEntity="DynamicJSDomEvent", mappedBy="parentDynamicJSDomEvents", cascade={"persist", "remove"})
     */
    protected $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEvents';
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

    /**
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS $dynamicJ
     */
    public function setDynamicJ($dynamicJ)
    {
        $this->dynamicJ = $dynamicJ;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS
     */
    public function getDynamicJ()
    {
        return $this->dynamicJ;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
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
}