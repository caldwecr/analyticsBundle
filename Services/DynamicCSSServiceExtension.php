<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 3:08 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager;

class DynamicCSSServiceExtension extends TrackingToolManagerExtensionService
{
    /**
     * @var DynamicCSSDomIdManager
     */
    protected $dynamicCSSDomIdManager;

    /**
     * @var DynamicCSSDomIdArrayCollectionManager
     */
    protected $dynamicCSSDomIdArrayCollectionManager;

    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var iTrackingToolRemover
     */
    protected $trackingToolRemover;

    /**
     * @var iTrackingToolValidator
     */
    protected $trackingToolValidator;

    /**
     * @var Object - the router service
     */
    protected $router;

    /**
     * @var iTrackerManager
     */
    protected $trackerManager;

    /**
     * @var string
     */
    protected $entityManagerName;

    public function __construct(DynamicCSSDomIdManager $dynamicCSSDomIdManager, DynamicCSSDomIdArrayCollectionManager $dynamicCSSDomIdArrayCollectionManager, $doctrine, iTrackingToolRemover $trackingToolRemover, iTrackingToolValidator $trackingToolValidator, $router, iTrackerManager $trackerManager, $entityManagerName)
    {
        $this->dynamicCSSDomIdManager = $dynamicCSSDomIdManager;
        $this->dynamicCSSDomIdArrayCollectionManager = $dynamicCSSDomIdArrayCollectionManager;
        $this->doctrine = $doctrine;
        $this->trackingToolRemover = $trackingToolRemover;
        $this->trackingToolValidator = $trackingToolValidator;
        $this->router = $router;
        $this->trackerManager = $trackerManager;
        $this->entityManagerName = $entityManagerName;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\DynamicCSSDomIdArrayCollectionManager
     */
    public function getDynamicCSSDomIdArrayCollectionManager()
    {
        return $this->dynamicCSSDomIdArrayCollectionManager;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\DynamicCSSDomIdManager
     */
    public function getDynamicCSSDomIdManager()
    {
        return $this->dynamicCSSDomIdManager;
    }

    public function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSServiceExtension';
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover
     */
    public function getTrackingToolRemover()
    {
        return $this->trackingToolRemover;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator
     */
    public function getTrackingToolValidator()
    {
        return $this->trackingToolValidator;
    }

    /**
     * @return Object
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager
     */
    public function getTrackerManager()
    {
        return $this->trackerManager;
    }

    /**
     * @return string
     */
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

}