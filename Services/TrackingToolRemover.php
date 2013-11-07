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
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespace;

class TrackingToolRemover extends CympelService implements iTrackingToolRemover
{
    protected $doctrine;


    protected $trackingToolValidator;

    protected $emName;

    /**
     * @var iNamespacer
     */
    protected $namespacer;

    /**
     * @var iNamespace
     */
    protected $myNamespace;

    /**
     * @var string
     */
    protected static $classAlias = 'TrackingToolRemover';

    public function __construct($doctrine, iTrackingToolValidator $trackingToolValidator, $entityManagerName, iNamespacer $namespacer, $namespaceName = '_blank')
    {
        $this->doctrine = $doctrine;
        $this->trackingToolValidator= $trackingToolValidator;
        $this->emName = $entityManagerName;
        $this->namespacer = $namespacer;
        $this->myNamespace = $this->namespacer->findOrCreateNamespaceByName($namespaceName);
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
        $this->namespacer->removeEntityFromCympelNamespace($tool, $this->myNamespace);

        $em->remove($tool);
        if($doFlush) $em->flush();
    }
}