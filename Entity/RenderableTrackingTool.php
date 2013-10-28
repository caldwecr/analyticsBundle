<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 9:34 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

abstract class RenderableTrackingTool extends TrackingTool
{
    /**
     * @param int $rendered
     * @return void
     */
    abstract public function setRendered($rendered);

    /**
     * @return int
     */
    abstract public function getRendered();

    /**
     * @param iTrackingTool $tool
     * @return RenderableTrackingTool
     */
    public static function cast(iTrackingTool $tool)
    {
        return self::typedCast($tool);
    }

    /**
     * @param RenderableTrackingTool $tool
     * @return RenderableTrackingTool
     */
    private static function typedCast(RenderableTrackingTool $tool)
    {
        return $tool;
    }
}