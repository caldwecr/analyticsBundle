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

/**
 * Class DynamicJS
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJS")
 */
class DynamicJS implements iTrackingTool
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
     * @param iTracker $tracker
     * @return bool
     */
    public function setTracker(iTracker $tracker)
    {
        // TODO: Implement setTracker() method.
    }

    /**
     * @return iTracker
     */
    public function getTracker()
    {
        // TODO: Implement getTracker() method.
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJS';
    }

}