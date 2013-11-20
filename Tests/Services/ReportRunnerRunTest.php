<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 2:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Doctrine\Common\Collections\ArrayCollection;

class ReportRunnerRunTest extends ContainerAwareUnitTestCase
{
    private $hasRun = false;

    private $hasCompletedSuccessfully = false;

    private $hasAbended = false;

    public function testRunnerRun()
    {
        // Register services
        $reportRunner = $this->get('ca.report.runner');
        $creator = $this->get('ca.generics.creator');
        $rtp = $this->get('ca.rtp');



        // Instantiate required entities
        $report = $creator->create('Report');
        $reportName = microtime(true);
        $report->setName($reportName);
        $query =    "SELECT rt
                    FROM CympelAnalyticsBundle:RouteTraffic rt
                    WHERE rt.name LIKE :name";
        $report->setQuery($query);

        $reportRun = $creator->create('ReportRun');
        $report->setReportRuns(new ArrayCollection(array($reportRun)));
        $reportRun->setStatus('new');

        // This is the string that the RouteTrafficPersister will write to the database and we will try to query it
        $persistedString = $reportName . 'created by ReportRunnerRunTest';

        $reportRun->setParameters(array(
            'name' => $persistedString,
        ));
        $reportRun->setReport($report);



        $callbacks = array(
            'onRun' => array($this, 'callbackRunning'),
            'onCompletedSuccessfully' => array($this, 'callbackOnCompletedSuccessfully'),
            'onAbend' => array($this, 'callbackOnAbend'),
        );
        $reportRun->setCallbacks($callbacks);

        // Persist the test string
        $rtp->persist($persistedString);

        // Run the ReportRun entity through the ReportRunner
        $reportRunNumber = $reportRunner->queueRun($reportRun);

        // Validate callbacks were invoked
        $this->assertEquals(true, $this->hasRun);
        $this->assertEquals(true, $this->hasCompletedSuccessfully);
        $this->assertEquals(false, $this->hasAbended);

        // Validate ReportRunResult
        $resultData = $reportRun->getResult()->getData();
        $this->assertTrue(is_array($resultData));
        $this->assertGreaterThan(0, count($resultData));
    }

    public function callbackRunning()
    {
        $this->hasRun = true;
    }

    public function callbackOnCompletedSuccessfully()
    {
        $this->hasCompletedSuccessfully = true;
    }

    public function callbackOnAbend()
    {
        $this->hasAbended = true;
    }
}
