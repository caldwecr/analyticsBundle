<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 2:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;

class TrackerManager implements iType
{
    protected $doctrine;

    protected $emName;

    protected $repositoryName;

    public function __construct($doctrine, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->repositoryName = 'Tracker';
    }

    /**
     * @return Tracker
     */
    public function create()
    {
        $t = new Tracker();
        return $t;
    }

    /**
     * @param iTracker $tracker
     * @param iTrackingTool $tool
     * @return bool
     */
    public function addTrackingTool(iTracker $tracker, iTrackingTool $tool)
    {
        $tools = $tracker->getTrackingTools();
        $tools->add($tool);
        $tracker->setTrackingTools($tools);
        return true;
    }
    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'TrackerManager';
    }

    public function remove(iTracker $tracker)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($tracker);
        $em->flush();
    }

    public function persist(iTracker $tracker)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($tracker);
        $em->flush();
    }

    public function findOneById($id)
    {
        $repository = $this->doctrine->getRepository($this->repositoryName);
        $tracker = $repository->findOneById($id);
        return $tracker;
    }

}