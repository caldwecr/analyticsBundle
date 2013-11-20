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

interface iReportRunner extends iService
{
    /**
     * @param iReport $report
     * @return int
     *
     * This method places a report in the report queue to be run and returns an integer which can be used to identify the report instance
     * that is being run
     */
    public function queueReport(iReportRun $reportRun);
}