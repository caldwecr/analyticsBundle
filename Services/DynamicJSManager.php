<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 11:52 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

class DynamicJSManager extends TrackingToolManager
{
    protected $repositoryName;

    public function __construct(TrackerManager $trackerManager)
    {
        $this->trackerManager = $trackerManager;
        $this->repositoryName = 'CympelAnalyticsBundle:DynamicJS';
    }

    /**
     * @return iTrackingTool
     */
    protected function createTrackingTool()
    {
        return new DynamicJS();
    }

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @param iTrackingTool $tool
     * @param iPropertySet $properties
     * @return iTrackingTool
     */
    public function setProperties(iTrackingTool $tool, iPropertySet $properties)
    {
        // TODO: Implement setProperties() method.
    }

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * This method must return all bindings on the tracking tool
     */
    public function getProperties(iTrackingTool $tool)
    {
        // TODO: Implement getProperties() method.
    }

    /**
     * @param iTrackingTool $tool
     * @return bool
     *
     * This method should cause the tool's properties to be validated
     */
    public function validate(iTrackingTool $tool)
    {
        // TODO: Implement validate() method.
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        // TODO: Implement getType() method.
    }

    public function generateOneTimeJavascript($ids, $targetEventName)
    {
        $t = $this->trackerManager->create();
        $dj = $this->create($t);
    }

}