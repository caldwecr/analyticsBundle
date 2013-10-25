<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 9:34 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

abstract class RenderableTrackingTool implements iTrackingTool
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
}