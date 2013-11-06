<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:09 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSetDomClasses;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DynamicJSSelectorDomEventClientDataSetDomClasses
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectorDomEventClientDataSetDomClasses")
 */
class DynamicJSSelectorDomEventClientDataSetDomClasses extends CympelType implements iDynamicJSSelectorDomEventClientDataSetDomClasses
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicJSSelectorDomEventClientDataSetDomClass", mappedBy="parentClasses", cascade={"persist", "remove"})
     */
    protected $classes;

    /**
     * @var DynamicJSSelectorDomEventClientDataSet
     * @ORM\OneToOne(targetEntity="DynamicJSSelectorDomEventClientDataSet", inversedBy="clientClasses", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="clientdatasset_id", referencedColumnName="id")
     */
    protected $dataSet;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicJSSelectorDomEventClientDataSetDomClasses';

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
     * @param ArrayCollection $classes
     */
    public function setClasses(ArrayCollection $classes)
    {
        $this->classes = $classes;
    }

    /**
     * @return ArrayCollection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param iDynamicJSSelectorDomEventClientDataSet $dataSet
     */
    public function setDataSet(iDynamicJSSelectorDomEventClientDataSet $dataSet)
    {
        $this->dataSet = $dataSet;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSet
     */
    public function getDataSet()
    {
        return $this->dataSet;
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