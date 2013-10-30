<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 1:46 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

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
     * @ORM\OneToOne(targetEntity="DynamicJSSelectorDomEvent", inversedBy="clientDataSets")
     * @ORM\JoinColumn(name="selectordomevent_id", referencedColumnName="id")
     */
    protected $selectorDomEvent;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicJSSelectorDomEventClientDataSet", mappedBy="parentDataSets")
     */
    protected $dataSets;

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
        return 'DynamicJSSelectorDomEventClientDataSets';
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $dataSets
     */
    public function setDataSets($dataSets)
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
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEvent $selectorDomEvent
     */
    public function setSelectorDomEvent($selectorDomEvent)
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

}