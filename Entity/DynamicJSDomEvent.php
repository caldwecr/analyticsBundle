<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:49 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
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
    protected $parentDynamicJDomEvents;

    /**
     * @var string
     */
    protected  $repositoryName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicJSDomEvent';

    public function __construct()
    {
        $this->eventName = '';
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
     * @param $parentDynamicJDomEvents
     */
    public function setParentDynamicJDomEvents(iDynamicJSDomEvents $parentDynamicJDomEvents)
    {
        $this->parentDynamicJDomEvents = $parentDynamicJDomEvents;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents
     */
    public function getParentDynamicJDomEvents()
    {
        return $this->parentDynamicJDomEvents;
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
     * @return string
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @return string
     */
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

    /**
     * @param string $repositoryName
     * @return void
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }

    /**
     * @param string $entityManagerName
     * @return void
     */
    public function setEntityManagerName($entityManagerName)
    {
        $this->entityManagerName = $entityManagerName;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }
}