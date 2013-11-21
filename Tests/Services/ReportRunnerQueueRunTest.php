<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 1:24 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Services\ReportRunner;

class ReportRunnerQueueRunTest extends ContainerAwareUnitTestCase
{
    public function testQueueRun()
    {
        $rr = $this->get('ca.report.runner');
        $report = $this->get('ca.generics.creator')->create('Report');
        $report->setQuery('SELECT 1 FROM CympelAnalyticsBundle:ConcretePersistableTestType');
        $reportRun = $this->get('ca.generics.creator')->create('ReportRun');
        $callbacks = array(
            'onRun' => array($this, 'callbackRunning'),
            'onCompletedSuccessfully' => array($this, 'callbackOnCompletedSuccessfully'),
            'onAbend' => array($this, 'callbackOnAbend'),
        );
        $reportRun->setReport($report);
        $reportRun->setCallbacks($callbacks);

        $number = $rr->queueRun($reportRun);

        // The queueRun method should return a non-negative integer
        $this->assertNotNull($number);
        $this->assertGreaterThanOrEqual(0, $number);
    }

    public function callbackRunning()
    {

    }

    public function callbackOnCompletedSuccessfully()
    {

    }

    public function callbackOnAbend()
    {

    }
}
