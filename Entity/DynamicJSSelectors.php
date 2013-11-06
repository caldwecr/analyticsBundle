<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:59 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectors;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DynamicJSSelectors
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectors")
 */
class DynamicJSSelectors extends CympelType implements iDynamicJSSelectors
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
     * @ORM\OneToOne(targetEntity="DynamicJS", inversedBy="dynamicJSelectors", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="dynamicJsId", referencedColumnName="id")
     */
    protected $dynamicJ;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicJSSelector", mappedBy="parentSelectors", cascade={"persist", "remove"})
     */
    protected $selectors;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicJSSelectors';

    public function __construct()
    {
        $this->created = time();
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

    public function toArray()
    {
        return $this->selectors->toArray();
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

}