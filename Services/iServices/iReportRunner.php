<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:28 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\ToolsBundle\Services\iServices\iService;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRun;

interface iReportRunner extends iService, iExtender
{

    /**
     * @param iReportRun $reportRun
     * @return int
     *
     * This method queues a report run to be run, it returns an integer
     * which can be used to query for a report run from the runner using
     * the getReportRunFromQueue method
     */
    public function queueRun(iReportRun $reportRun);

    /**
     * @param int $reportRunNumber
     * @return iReportRun
     *
     * The first argument of this method should be an integer that was issued by the queueRun method
     */
    public function getReportRunFromQueue($reportRunNumber);

    /**
     * @return void
     *
     * This method causes the runner's queue to be checked and attempt to process the items in the queue
     * until the queue is empty; if the runner is already running this has no effect
     */
    public function run();
}