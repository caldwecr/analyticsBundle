<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 2:29 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;


use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DynamicJS
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJS")
 */
class DynamicJS extends RoutedTrackingTool implements iDynamicJS
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
     * @ORM\OneToOne(targetEntity="DynamicJSSelectors", mappedBy="dynamicJ", cascade={"persist", "remove"})
     */
    protected $dynamicJSelectors;

    /**
     * @var DynamicJSDomEvents
     * @ORM\OneToOne(targetEntity="DynamicJSDomEvents", mappedBy="dynamicJ", cascade={"persist", "remove"})
     */
    protected $events;

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
    protected static $classAlias = 'DynamicJS';

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
     * @param iType $rightSide
     * @return bool
     */
    protected function typedEquals(iType $rightSide)
    {
        return $this->internalEquals($rightSide);
    }

    /**
     * @param DynamicJS $rightSide
     * @return bool
     */
    private function internalEquals(DynamicJS $rightSide)
    {
        foreach($this as $key => $value)
        {
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


    /**
     * @param iDynamicJSSelectors $dynamicJSelectors
     */
    public function setDynamicJSelectors(iDynamicJSSelectors $dynamicJSelectors)
    {
        $this->dynamicJSelectors = $dynamicJSelectors;
    }

    /**
     * @return DynamicJSSelectors
     */
    public function getDynamicJSelectors()
    {
        return $this->dynamicJSelectors;
    }

    /**
     * @param iDynamicJSDomEvents $events
     */
    public function setEvents(iDynamicJSDomEvents $events)
    {
        $this->events = $events;
    }

    /**
     * @return DynamicJSDomEvents
     */
    public function getEvents()
    {
        return $this->events;
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

}