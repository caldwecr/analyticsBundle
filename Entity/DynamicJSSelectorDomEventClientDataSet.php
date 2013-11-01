<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 1:37 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSetDomClasses;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSets;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DynamicJSSelectorDomEventClientDataSet
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectorDomEventClientDataSet")
 */
class DynamicJSSelectorDomEventClientDataSet extends CympelType implements iDynamicJSSelectorDomEventClientDataSet
{
    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     */
    protected $repositoryName;

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
    protected $clientX;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     */
    protected $clientY;

    /**
     * @var DynamicJSSelectorDomEventClientDataSetDomClasses
     * @ORM\OneToOne(targetEntity="DynamicJSSelectorDomEventClientDataSetDomClasses", mappedBy="dataSet", cascade={"persist", "remove"})
     */
    protected $clientClasses;

    /**
     * @var DynamicJSSelectorDomEventClientDataSets
     * @ORM\ManyToOne(targetEntity="DynamicJSSelectorDomEventClientDataSets", inversedBy="dataSets", cascade={"persist"})
     * @ORM\JoinColumn(name="parentDataSet_id", referencedColumnName="id")
     */
    protected $parentDataSets;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $clientDomElementId;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    protected $clientEventType;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $clientOuterHTML;

    public function __construct()
    {
        $this->clientDomElementId = '';
        $this->clientEventType = '';
        $this->clientOuterHTML = '';
        $this->clientX = 0;
        $this->clientY = 0;
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

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorDomEventClientDataSet';
    }

    /**
     * @param iDynamicJSSelectorDomEventClientDataSetDomClasses $clientClasses
     */
    public function setClientClasses(iDynamicJSSelectorDomEventClientDataSetDomClasses $clientClasses)
    {
        $this->clientClasses = $clientClasses;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSetDomClasses
     */
    public function getClientClasses()
    {
        return $this->clientClasses;
    }

    /**
     * @param string $clientDomElementId
     */
    public function setClientDomElementId($clientDomElementId)
    {
        $this->clientDomElementId = $clientDomElementId;
    }

    /**
     * @return string
     */
    public function getClientDomElementId()
    {
        return $this->clientDomElementId;
    }

    /**
     * @param string $clientEventType
     */
    public function setClientEventType($clientEventType)
    {
        $this->clientEventType = $clientEventType;
    }

    /**
     * @return string
     */
    public function getClientEventType()
    {
        return $this->clientEventType;
    }

    /**
     * @param string $clientOuterHTML
     */
    public function setClientOuterHTML($clientOuterHTML)
    {
        $this->clientOuterHTML = $clientOuterHTML;
    }

    /**
     * @return string
     */
    public function getClientOuterHTML()
    {
        return $this->clientOuterHTML;
    }

    /**
     * @param int $clientX
     */
    public function setClientX($clientX)
    {
        $this->clientX = $clientX;
    }

    /**
     * @return int
     */
    public function getClientX()
    {
        return $this->clientX;
    }

    /**
     * @param int $clientY
     */
    public function setClientY($clientY)
    {
        $this->clientY = $clientY;
    }

    /**
     * @return int
     */
    public function getClientY()
    {
        return $this->clientY;
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
     * @param iDynamicJSSelectorDomEventClientDataSets $parentDataSets
     */
    public function setParentDataSets(iDynamicJSSelectorDomEventClientDataSets $parentDataSets)
    {
        $this->parentDataSets = $parentDataSets;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSets
     */
    public function getParentDataSets()
    {
        return $this->parentDataSets;
    }
}