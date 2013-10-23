<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:46 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

interface iTrackingToolManager extends iType
{
    /**
     * @param iTracker $tracker
     * @return iTrackingTool
     *
     * This method creates a brand new tracking tool that is a child to the first argument
     */
    public function create(iTracker $tracker);

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
     * @return iTrackingTool
     *
     * This method should scan the database for an instance of the TrackingTool of appropriate type and id
     */
    public function findOneById($id);

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

    /**
     * @param iTrackingTool $tool
     * @return bool
     *
     * This method should cause the tool's properties to be validated
     */
    public function validate(iTrackingTool $tool);

}