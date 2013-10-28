<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:59 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DynamicJSSelectors
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectors")
 */
class DynamicJSSelectors implements iType
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     */
    protected $created;

    /**
     * @var DynamicJS
     * @ORM\OneToOne(targetEntity="DynamicJS", inversedBy="dynamicJSelectors", cascade={"persist"})
     * @ORM\JoinColumn(name="dynamicJsId", referencedColumnName="id")
     */
    protected $dynamicJ;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicJSSelector", mappedBy="parentSelectors", cascade={"persist", "remove"})
     */
    protected $selectors;

    public function __construct()
    {
        $this->created = time();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectors';
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $dynamicJ
     */
    public function setDynamicJ($dynamicJ)
    {
        $this->dynamicJ = $dynamicJ;
    }

    /**
     * @return mixed
     */
    public function getDynamicJ()
    {
        return $this->dynamicJ;
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
     * @param \Doctrine\Common\Collections\ArrayCollection $selectors
     */
    public function setSelectors($selectors)
    {
        $this->selectors = $selectors;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * @param DynamicJSSelectors $rightSide
     * @return bool
     */
    public function equals(DynamicJSSelectors $rightSide)
    {
        foreach($this as $key => $value) {
            if($value !== $rightSide->$key) {
                return false;
            }
        }
        return true;
    }

}