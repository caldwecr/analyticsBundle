<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:25 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;

/**
 * Class Tracker
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tracker")
 */
class Tracker extends CympelType implements iTracker
{
    /**
     * @var int
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     */
    protected $created;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $createdByRoute;

    /**
     * @var ArrayCollection
     */
    protected $trackingTools;

    /**
     * @var string
     */
    protected static $classAlias = 'Tracker';

    /**
     * This method initializes properties
     */
    public function __construct()
    {
        $this->created = time();
        $this->createdByRoute = '';
        $this->trackingTools = new ArrayCollection();
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        return self::areEqual($this,$rightSide);
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
     * @param string $createdByRoute
     */
    public function setCreatedByRoute($createdByRoute)
    {
        $this->createdByRoute = $createdByRoute;
    }

    /**
     * @return string
     */
    public function getCreatedByRoute()
    {
        return $this->createdByRoute;
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
     * @param ArrayCollection $tools
     */
    public function setTrackingTools(ArrayCollection $tools)
    {
        $this->trackingTools = $tools;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTrackingTools()
    {
        return $this->trackingTools;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }
}