<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:25 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Tracker
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="Tracker")
 */
class Tracker implements iTracker
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
     * @ORM\OneToMany(targetEntity="DynamicCSS", mappedBy="tracker", cascade={"persist", "remove"})
     * @ORM\OneToMany(targetEntity="DynamicJS", mappedBy="tracker", cascade={"persist", "remove"})
     */
    protected $trackingTools;

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
     * @param iTracker $rightSide
     * @return bool
     *
     * This method evaluates the equality of the object against the argument
     */
    public function equals(iTracker $rightSide)
    {
        foreach($this as $key => $value) {
            if($value !== $rightSide->$key) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'Tracker';
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
}