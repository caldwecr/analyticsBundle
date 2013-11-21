<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/21/13
 * Time: 11:02 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Services\Exception\ReportRunnerReportRunNullReportException;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ReportRunnerReportRunHasNullReportTest extends ContainerAwareUnitTestCase
{
    public function testReportRunHasNullReport()
    {
        // Register services
        $creator = $this->get('ca.generics.creator');
        $rr = $this->get('ca.report.runner');

        // Create ReportRun
        $reportRun = $creator->create('ReportRun');

        // Queue the ReportRun and catch expected ReportRunnerReportRunNullReportException
        try {
            $rr->queueRun($reportRun);
        } catch (ReportRunnerReportRunNullReportException $e) {

        }
        $this->assertNotNull($e);

    }
}
