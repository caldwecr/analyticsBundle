<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManagerExtensionService;

abstract class TrackingToolManager extends CympelManager implements iTrackingToolManager
{
    /**
     * @return TrackerManager
     */
    public function getTrackerManager()
    {
        $e = $this->getExtender();
        return self::getTrackerManagerCheckingExtenderType($e);
    }

    /**
     * @param iTrackingToolManagerExtensionService $extender
     * @return iTrackerManager
     */
    protected static final function getTrackerManagerCheckingExtenderType(iTrackingToolManagerExtensionService $extender)
    {
        return $extender->getTrackerManager();
    }

    /**
     * @param iExtender $extension
     *
     * This is accomplishing type checking of the extension service
     */
    public final function processExtension(iExtender $extension)
    {
        $this->internalProcessExtension($extension);
    }

    /**
     * @param iTrackingToolManagerExtensionService $extension
     * @return void
     */
    abstract protected function internalProcessExtension(iTrackingToolManagerExtensionService $extension);

    /**
     * @param iTracker $tracker
     * @param iTrackingTool $tool
     * @return iTrackingTool
     */
    protected final function attachTracker(iTracker $tracker, iTrackingTool $tool)
    {
        $tool->setTracker($tracker);
        $this->getTrackerManager()->addTrackingTool($tracker, $tool);
        return $tool;
    }

    /**
     * @param iTrackingTool $tool
     * @param iPropertySet $properties
     * @return iTrackingTool
     */
    public function setProperties(iTrackingTool $tool, iPropertySet $properties)
    {
        return $properties->pushTo($tool);
    }

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * This method must return all bindings on the tracking tool
     */
    public function getProperties(iTrackingTool $tool)
    {
        $p = $this->createPropertySet();
        return $p->pullFrom($tool);
    }

    /**
     * @return iPropertySet
     */
    abstract protected function createPropertySet();

    /**
     * @param $classAlias
     * @param iTracker $tracker
     * @param string $namespaceName
     * @return iTrackingTool
     */
    public function createTrackingTool($classAlias, iTracker $tracker, $namespaceName = '_blank')
    {
        if(!$tracker) {
            $tracker = $this->getTrackerManager()->create();
        }
        $tt = $this->getCreator()->create($classAlias);
        $namespace = $this->getNamespacer()->findOrCreateNamespaceByName($namespaceName);
        $this->attachTracker($tracker, $tt);
        $this->getPersister()->persist($tt);
        $namespacer = $this->getNamespacer();
        $namespacer->removeEntityFromDefaultCympelNamespaces($tt);
        $this->getNamespacer()->addEntityToCympelNamespace($tt, $namespace);
        return $tt;
    }
}