<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:55 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJS;
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
     * @ORM\OneToMany(targetEntity="DynamicJSDomEvent", mappedBy="parentDynamicJDomEvents", cascade={"persist", "remove"})
     */
    protected $events;

    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicJSDomEvents';

    public function __construct()
    {
        $this->events = new ArrayCollection();
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
     * @param iDynamicJS $dynamicJ
     */
    public function setDynamicJ(iDynamicJS $dynamicJ)
    {
        $this->dynamicJ = $dynamicJ;
    }

    /**
     * @return DynamicJS
     */
    public function getDynamicJ()
    {
        return $this->dynamicJ;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $events
     */
    public function setEvents(ArrayCollection $events)
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

    public function toArray()
    {
        return $this->events->toArray();
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
     * @return string
     *
     * This method must return the fully qualified repository name
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
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

}