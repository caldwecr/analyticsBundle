<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException;
use Cympel\Bundle\AnalyticsBundle\Entity\iPropertySet;

abstract class TrackingToolManager implements iTrackingToolManager
{
    /**
     * @var TrackerManager
     */
    protected $trackerManager;

    protected $doctrine;

    protected $emName;

    protected $validator;

    /**
     * @param iTracker $tracker
     * @return iTrackingTool
     *
     * This method creates a brand new tracking tool that is a child to the first argument
     */
    public final function create(iTracker $tracker)
    {
        $tt = $this->createTrackingTool($tracker);

        $tt->setTracker($tracker);
        $this->trackerManager->addTrackingTool($tracker, $tt);
        return $tt;
    }

    /**
     * @return iTrackingTool
     */
    abstract protected function createTrackingTool();

    /**
     * @param $id
     * @return iTrackingTool
     *
     * This method should scan the database for an instance of the TrackingTool of appropriate type and id
     */
    public function findOneById($id)
    {
        $repositoryName = $this->getRepositoryName();
        $repository = $this->doctrine->getRepository($repositoryName, $this->emName);
        $tt = $repository->findOneById($id);
        return $tt;
    }

    /**
     * @param $entityManagerName
     * @return void
     *
     * This method must set the manager's entity manager name property
     */
    public function setEntityManagerName($entityManagerName)
    {
        $this->emName = $entityManagerName;
    }

    /**
     * @return string
     *
     * This method must return the manager's entity manager name
     */
    public function getEntityManagerName()
    {
        return $this->emName;
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
        $em = $this->doctrine->getManager($this->emName);
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
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($tool);
        $em->flush();
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
        $errors = $this->validator->validate($tool);
        if(count($errors) > 0) {
            return false;
        }
        return true;
    }
}