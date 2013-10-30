<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;

abstract class TrackingToolManager extends CympelService implements iTrackingToolManager
{
    /**
     * @return TrackerManager
     */
    abstract protected function getTrackerManager();

    /**
     * @param TrackerManager $trackerManager
     * @return void
     */
    abstract protected function setTrackerManager(TrackerManager $trackerManager);

    /**
     * @return Object - the doctrine service
     */
    abstract protected function getDoctrine();

    /**
     * @param $doctrine
     * @return void
     */
    abstract protected function setDoctrine($doctrine);

    /**
     * @return string
     */
    abstract protected function getEmName();

    /**
     * @param string $emName
     * @return void
     */
    abstract protected function setEmName($emName);

    /**
     * @return iTrackingToolValidator
     */
    abstract protected function getTrackingToolValidator();

    /**
     * @param iTrackingToolValidator $trackingToolValidator
     * @return void
     */
    abstract protected function setTrackingToolValidator(iTrackingToolValidator $trackingToolValidator);

    /**
     * @return iTrackingToolRemover
     */
    abstract protected function getTrackingToolRemover();

    /**
     * @param iTrackingToolRemover $trackingToolRemover
     * @return void
     */
    abstract protected function setTrackingToolRemover(iTrackingToolRemover $trackingToolRemover);

    /**
     * @param string $classAlias
     * @param iTracker $tracker
     * @return iTrackingTool
     */
    public final function create($classAlias, iTracker $tracker = null)
    {
        if(!$tracker) {
            $tracker = $this->getTrackerManager()->create();
        }
        $tt = $this->getCreator()->create($classAlias);

        return $this->attachTracker($tracker, $tt);
    }

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
     * @return iCreator
     */
    abstract protected function getCreator();

    /**
     * @param $id
     * @param $classAlias
     * @return iFindable
     */
    public function findOneByIdAndClassAlias($id, $classAlias)
    {
        return $this->getFinder()->findOneByIdAndClassAlias($id, $classAlias);
    }

    /**
     * @return iFinder
     */
    abstract protected function getFinder();

    /**
     * @param $entityManagerName
     * @return void
     *
     * This method must set the manager's entity manager name property
     */
    public function setEntityManagerName($entityManagerName)
    {
        $this->setEmName($entityManagerName);
    }

    /**
     * @return string
     *
     * This method must return the manager's entity manager name
     */
    public function getEntityManagerName()
    {
        return $this->getEmName();
    }

    /**
     * @return string
     */
    abstract protected function getRepositoryName();

    /**
     * @param iTrackingTool $tool
     * @return bool|void
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException
     */
    public function persist(iTrackingTool $tool)
    {
        if(!$this->validate($tool)) {
            throw new InvalidTrackingToolException();
        }
        $em = $this->getDoctrine()->getManager($this->getEmName());
        $em->persist($tool);
        $em->flush();
    }

    /**
     * @param iTrackingTool $tool
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException
     * @return bool
     *
     * This method should remove a tracking tool from the database
     */
    public function remove(iTrackingTool $tool)
    {
        if(!$this->validate($tool)) {
            throw new InvalidTrackingToolException();
        }
        $this->getTrackingToolRemover()->remove($tool);
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
     * @param iTrackingTool $tool
     * @return bool
     *
     * This method should cause the tool's properties to be validated
     */
    public function validate(iTrackingTool $tool)
    {
        if(!$tool->hasValidationConstraints()) {
            return true;
        }
        return $this->getTrackingToolValidator()->validate($tool);
    }
}