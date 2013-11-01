<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:46 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iTrackingToolManager extends iType, iValidate, iPersist, iFind, iRemove, iCreate
{
    /**
     * @param string $classAlias
     * @param iTracker $tracker
     * @return iTrackingTool
     *
     * This method creates a new tracking tool that is the descendant of the first argument
     */
    public function create($classAlias, iTracker $tracker = null);

    /**
     * @param iTrackingTool $tool
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException
     * @return bool
     *
     * This method should persist a tracking tool to the database
     */
    public function persist(iTrackingTool $tool);

    /**
     * @param iTrackingTool $tool
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException
     * @return bool
     *
     * This method should remove a tracking tool from the database
     */
    public function remove(iTrackingTool $tool);


    /**
     * @param $id
     * @param $classAlias
     * @return iFindable
     */
    public function findOneByIdAndClassAlias($id, $classAlias);

    /**
     * @param $entityManagerName
     * @return void
     *
     * This method must set the manager's entity manager name property
     */
    public function setEntityManagerName($entityManagerName);

    /**
     * @return string
     *
     * This method must return the manager's entity manager name
     */
    public function getEntityManagerName();

    /**
     * @param iTrackingTool $tool
     * @param iPropertySet $properties
     * @return iTrackingTool
     */
    public function setProperties(iTrackingTool $tool, iPropertySet $properties);

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * This method must return all bindings on the tracking tool
     */
    public function getProperties(iTrackingTool $tool);
}