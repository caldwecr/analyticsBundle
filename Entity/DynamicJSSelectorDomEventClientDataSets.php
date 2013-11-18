<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 1:46 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSets;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DynamicJSSelectorDomEventClientDataSets
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectorDomEventClientDataSets")
 */
class DynamicJSSelectorDomEventClientDataSets extends CympelType implements iDynamicJSSelectorDomEventClientDataSets
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
     * @var DynamicJSSelectorDomEvent
     * @ORM\OneToOne(targetEntity="DynamicJSSelectorDomEvent", inversedBy="clientDataSets", cascade={"persist"})
     * @ORM\JoinColumn(name="selectordomevent_id", referencedColumnName="id")
     *
     * @todo Ultimately this should be set as nullable = false
     */
    protected $selectorDomEvent;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicJSSelectorDomEventClientDataSet", mappedBy="parentDataSets", cascade={"persist", "remove"})
     */
    protected $dataSets;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicJSSelectorDomEventClientDataSets';

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
     * @param \Doctrine\Common\Collections\ArrayCollection $dataSets
     */
    public function setDataSets(ArrayCollection $dataSets)
    {
        $this->dataSets = $dataSets;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDataSets()
    {
        return $this->dataSets;
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
     * @param iDynamicJSSelectorDomEvent $selectorDomEvent
     */
    public function setSelectorDomEvent(iDynamicJSSelectorDomEvent $selectorDomEvent)
    {
        $this->selectorDomEvent = $selectorDomEvent;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEvent
     */
    public function getSelectorDomEvent()
    {
        return $this->selectorDomEvent;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

}