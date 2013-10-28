<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 2:29 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DynamicJS
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJS")
 */
class DynamicJS extends RoutedTrackingTool
{
    /**
     * @var int
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var iTracker
     * @ORM\ManyToOne(targetEntity="Tracker", inversedBy="trackingTools", cascade={"persist"})
     * @ORM\JoinColumn(name="tracker_id", referencedColumnName="id")
     */
    protected $tracker;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     *
     * The unix timestamp when the DynamicJS instance was rendered and then sent to the client
     */
    protected $rendered;


    /**
     * @var DynamicJSSelectors
     * @ORM\OneToOne(targetEntity="DynamicJSSelectors", inversedBy="dynamicJ")
     */
    protected $dynamicJSelectors;

    protected $events;

    public function __construct()
    {
        $this->rendered = 0;
    }

    /**
     * @param iTracker $tracker
     * @return bool
     */
    public function setTracker(iTracker $tracker)
    {
        $this->tracker = $tracker;
    }

    /**
     * @return iTracker
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJS';
    }

    /**
     * @param iTrackingTool $rightSide
     * @return bool
     */
    public function equals(iTrackingTool $rightSide)
    {
        foreach($this as $key => $value) {
            if($value !== $rightSide->$key) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     *
     * This method must return true if the tool has validation constraints that should be checked, otherwise false
     */
    public function hasValidationConstraints()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $rendered
     * @return void
     */
    public function setRendered($rendered)
    {
        $this->rendered = $rendered;
    }

    /**
     * @return int
     */
    public function getRendered()
    {
        return $this->rendered;
    }

}