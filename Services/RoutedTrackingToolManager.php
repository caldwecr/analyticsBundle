<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\RoutedTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRoutedTrackingToolManagerExtender;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManagerExtensionService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRouter;

abstract class RoutedTrackingToolManager extends TrackingToolManager
{
    /**
     * @param iTrackingToolManagerExtensionService $extension
     * @return void
     */
    protected function internalProcessExtension(iTrackingToolManagerExtensionService $extension)
    {
        $this->typedProcessExtension($extension);
    }

    /**
     * @param iRoutedTrackingToolManagerExtender $extender
     */
    private function typedProcessExtension(iRoutedTrackingToolManagerExtender $extender)
    {
        // all i do is verfiy type of the extension
    }

    /**
     * @param iTrackingTool $tool
     * @param bool $type
     * @return string
     */
    public function generateUrl(iTrackingTool $tool, $type = URLGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->getRouter()->generate($this->getRouteName(),
            $this->getRoutingArray($tool),
            $type
        );
    }

    /**
     * @param string $classAlias
     * @param iPropertySet $properties
     * @param iTracker $tracker
     * @param string $namespaceName
     * @return string
     */
    public function generate($classAlias, iPropertySet $properties, iTracker $tracker = null, $namespaceName = '_blank')
    {
        if(!$tracker) $tracker = $this->getTrackerManager()->create();
        $tool = $this->createTrackingTool($classAlias, $tracker, $namespaceName);
        $fProperties = $this->finalizeProperties($properties, $tool, $namespaceName);
        $this->setProperties($tool, $fProperties);
        $this->getPersister()->persist($tool);
        return $this->generateUrl($tool, UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    /**
     * @param string $classAlias
     * @param $id
     * @return mixed
     *
     * This method is invoked by the Default Controller to render a DynamicCSS
     */
    public function renderById($classAlias, $id)
    {
        $toReturn = RoutedTrackingTool::cast($this->getFinder()->findOneByIdAndClassAlias($id, $classAlias));
        $toReturn->setRendered(time());
        $this->getPersister()->persist($toReturn);
        return $toReturn;
    }

    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @return iPropertySet
     *

     */
    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @param string $namespaceName
     * @return mixed
     *
     * The purpose of this method is to allow changes to the properties based on the tool's initialization
     * that would have otherwise been impossible prior to the tool's initialization
     * This is necessary for DynamicCSS tools so that the DomIds can be bound to the tool
     *
     * This method can also be used to cascade the RoutedTrackingTool's namespace to any of the entities it owns
     */
    abstract protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool, $namespaceName = '_blank');

    /**
     * @return string
     */
    abstract protected function getRouteName();

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    abstract protected function getRoutingArray(iTrackingTool $tool);


    /**
     * @return iRouter
     */
    public function getRouter()
    {
        return self::typedGetRouter($this->extender);
    }

    /**
     * @param iRoutedTrackingToolManagerExtender $extender
     * @return iRouter
     */
    private static function typedGetRouter(iRoutedTrackingToolManagerExtender $extender)
    {
        return $extender->getRouter();
    }
}