<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 11:52 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Services\DynamicJS\DynamicJSServiceExtension;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManagerExtensionService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;

class DynamicJSManager extends RoutedTrackingToolManager
{
    /**
     * @var string
     */
    protected $repositoryName;

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
     * @var string
     */
    protected $emName;

    /**
     * @var TrackerManager
     */
    protected $trackerManager;

    /**
     * @var Object -- the router service
     */
    protected $router;


    /**
     * @var DynamicJSServiceExtension
     */
    protected $trackingToolExtensionService;


    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        parent::__construct($creator, $finder, $persister, $remover, $validator, $extender);
        //$this->doctrine = $this->extender->getDoctrine();
        $this->trackingToolValidator = $this->extender->getTrackingToolValidator();
        $this->router = $this->extender->getRouter();
        $this->trackerManager = $this->extender->getTrackerManager();
        $this->emName = $this->extender->getEntityManagerName();
        $this->repositoryName = 'CympelAnalyticsBundle:DynamicJS';
    }

    /**
     * @param DynamicJSServiceExtension $extensionService
     * @return void
     */
    private function setExtensionService(DynamicJSServiceExtension $extensionService)
    {
        $this->trackingToolExtensionService = $extensionService;
    }

    /**
     * @return iTrackingToolRemover
     */
    protected function getTrackingToolRemover()
    {
        return $this->trackingToolRemover;
    }

    /**
     * @param iTrackingToolRemover $trackingToolRemover
     * @return void
     */
    protected function setTrackingToolRemover(iTrackingToolRemover $trackingToolRemover)
    {
        $this->trackingToolRemover = $trackingToolRemover;
    }

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @return iPropertySet
     */
    protected function createPropertySet()
    {
        return new DynamicJSPropertySet();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSManager';
    }

    /**
     * @return TrackerManager
     */
    protected function getTrackerManager()
    {
        return $this->trackerManager;
    }

    /**
     * @param TrackerManager $trackerManager
     * @return void
     */
    protected function setTrackerManager(TrackerManager $trackerManager)
    {
        $this->trackerManager = $trackerManager;
    }



    /**
     * @return string
     */
    protected function getEmName()
    {
        return $this->emName;
    }

    /**
     * @param string $emName
     * @return void
     */
    protected function setEmName($emName)
    {
        $this->emName = $emName;
    }

    /**
     * @return iTrackingToolValidator
     */
    protected function getTrackingToolValidator()
    {
        return $this->trackingToolValidator;
    }

    /**
     * @param iTrackingToolValidator $trackingToolValidator
     * @return void
     */
    protected function setTrackingToolValidator(iTrackingToolValidator $trackingToolValidator)
    {
        $this->trackingToolValidator = $trackingToolValidator;
    }

    /**
     * @param $classAlias
     * @param $selectors
     * @param $events
     * @param iTracker $tracker
     * @return string
     */
    public function generateOneTimeJavascript($classAlias, $selectors, $events, iTracker $tracker=null)
    {
        if(!$tracker) $tracker = $this->trackerManager->create();
        $properties = new DynamicJSPropertySet();
        // @todo implement and test the createFromArray method
        $properties->setEvents($this->trackingToolExtensionService->getDynamicJDomEventsManager()->createFromArray($events));
        // @todo create tests for this createFromArray method
        $properties->setDynamicJSelectors($this->trackingToolExtensionService->getDynamicJSelectorsManager()->createFromArray($selectors));
        $properties->setRendered(0);
        $properties->setTracker($tracker);
        return $this->generate($classAlias, $properties, $tracker);
    }

    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * The purpose of this method is to allow changes to the properties based on the tool's initialization
     * that would have otherwise been impossible prior to the tool's initialization
     * This is necessary for DynamicCSS tools so that the DomIds can be bound to the tool
     */
    protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool)
    {
        return $properties;
    }


    /**
     * @return string
     */
    protected function getRouteName()
    {
        return 'dynamicJS';
    }

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    protected function getRoutingArray(iTrackingTool $tool)
    {
        return array(
            'key' => $tool->getId(),
        );
    }



    /**
     * @return iCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return iFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    public function getDynamicJSelectors(DynamicJS $dynamicJS)
    {
        return $dynamicJS->getDynamicJSelectors()->toArray();
    }

    public function getDynamicJDomEvents(DynamicJS $dynamicJS)
    {
        return $dynamicJS->getEvents()->toArray();
    }
}