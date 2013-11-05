<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 11:14 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;

class TrackingToolRemover extends CympelService implements iTrackingToolRemover
{
    protected $doctrine;


    protected $trackingToolValidator;

    protected $emName;


    public function __construct($doctrine, iTrackingToolValidator $trackingToolValidator, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->trackingToolValidator= $trackingToolValidator;
        $this->emName = $entityManagerName;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'TrackingToolRemover';
    }

    /**
     * @param iTracker $tracker
     */
    public function removeToolsFromTracker(iTracker $tracker)
    {
        $tools = $tracker->getTrackingTools();
        foreach($tools as $key => $value) {
            $this->remove($value);
        }
        $this->doctrine->getManager($this->emName)->flush();
    }

    /**
     * @param iTrackingTool $tool
     * @param bool $doFlush
     * @return void
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException
     */
    public function remove(iTrackingTool $tool, $doFlush = true)
    {
        if(!$this->trackingToolValidator->validate($tool)) {
            throw new InvalidTrackingToolException();
        }
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($tool);
        if($doFlush) $em->flush();
    }
}