<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/21/13
 * Time: 11:18 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Services\Exception\ReportRunnerInvalidReportException;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ReportRunnerReportHasNullQueryTest extends ContainerAwareUnitTestCase
{
    public function testReportHasNullQuery()
    {
        // Register services
        $creator = $this->get('ca.generics.creator');
        $rr = $this->get('ca.report.runner');

        // Create Report and initialize properties, but set query equal to null
        $report = $creator->create('Report');
        $report->setName(microtime(true));
        $report->setQuery(null);
        // Create ReportRun
        $reportRun = $creator->create('ReportRun');
        $reportRun->setStatus('new');
        $report->addRun($reportRun);
        $reportRun->setReport($report);
        // Queue the ReportRun and catch expected ReportRunnerReportRunNullReportException
        try {
            $rr->queueRun($reportRun);
        } catch (ReportRunnerInvalidReportException $e) {

        }
        $this->assertNotNull($e);

    }
}
