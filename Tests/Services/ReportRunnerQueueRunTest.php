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
        $rr = new ReportRunner();
        $reportRun = $this->get('ca.generics.creator')->create('ReportRun');
        $callbacks = array(
            'onRun' => 'callbackRunning',
            'onCompletedSuccessfully' => 'callbackOnCompletedSuccessfully',
            'onAbend' => 'callbackOnAbend',
        );
        $reportRun->setCallbacks($callbacks);

        $number = $rr->queueRun($reportRun);

        // The queueRun method should return a non-negative integer
        $this->assertNotNull($number);
        $this->assertGreaterThanOrEqual(0, $number);

        // Validate the reportRun can be retrieved
        $reportRun2 = $rr->getReportRunFromQueue($number);
        $this->assertNotNull($reportRun2);
        $this->assertTrue($reportRun->equals($reportRun2));
        // Validate the callbacks are truly being compared for equality
        $callbacks2 = array(
            'onRun' => 'callbackRunningz',
            'onCompletedSuccessfully' => 'callbackOnCompletedSuccessfully',
            'onAbend' => 'callbackOnAbend',
        );
        $reportRun->setCallbacks($callbacks2);
        // This should pass as true because reportRun and reportRun2 are pointing at the same instance
        $this->assertTrue($reportRun->equals($reportRun2));
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
