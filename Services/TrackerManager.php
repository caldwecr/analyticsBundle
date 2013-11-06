<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 2:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager;

class TrackerManager extends CympelService implements iTrackerManager
{
    protected $doctrine;

    protected $emName;

    protected $repositoryName;

    protected $trackingToolRemover;

    /**
     * @var string
     */
    protected static $classAlias = 'TrackerManager';

    public function __construct($doctrine, $trackingToolRemover, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->repositoryName = 'CympelAnalyticsBundle:Tracker';
        $this->emName = $entityManagerName;
        $this->trackingToolRemover = $trackingToolRemover;
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
     * @param iTracker $tracker
     * @throws \Doctrine\DBAL\DBALException
     */
    public function unsafeRemove(iTracker $tracker)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($tracker);
        $em->flush();
    }

    public function remove(iTracker $tracker)
    {
        $this->trackingToolRemover->removeToolsFromTracker($tracker);
        $this->unsafeRemove($tracker);
    }

    public function persist(iTracker $tracker)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($tracker);
        $em->flush();
    }

    public function findOneById($id)
    {
        $repository = $this->doctrine->getRepository($this->repositoryName, $this->emName);
        $tracker = $repository->findOneById($id);
        return $tracker;
    }
}