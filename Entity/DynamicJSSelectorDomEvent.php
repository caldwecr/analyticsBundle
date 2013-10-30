<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 8:11 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;

/**
 * Class DynamicJSSelectorDomEvent
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectorDomEvent")
 */
class DynamicJSSelectorDomEvent extends CympelType implements iDynamicJSSelectorDomEvent
{
    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var iDynamicJSSelector
     * @ORM\ManyToOne(targetEntity="DynamicJSSelector")
     * @ORM\JoinTable(name="selector_selectordomevent",
     *      joinColumns={@ORM\JoinColumn(name="selectordomevent_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="selector_id", referencedColumnName="id", unique=true)}
     * )
     *
     * Note that the odd ORM approach here is how doctrine's documentation recommends implementing a one-to-many mono-directional association
     */
    protected $selector;

    /**
     * @var iDynamicJSDomEvent
     * @ORM\ManyToOne(targetEntity="DynamicJSDomEvent")
     * @ORM\JoinTable(name="event_selectordomevent",
     *      joinColumns={@ORM\JoinColumn(name="selectordomevent_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="domEvent_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $domEvent;

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
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorDomEvent';
    }

    /**
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent $domEvent
     */
    public function setDomEvent($domEvent)
    {
        $this->domEvent = $domEvent;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent
     */
    public function getDomEvent()
    {
        return $this->domEvent;
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
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector $selector
     */
    public function setSelector($selector)
    {
        $this->selector = $selector;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector
     */
    public function getSelector()
    {
        return $this->selector;
    }

}