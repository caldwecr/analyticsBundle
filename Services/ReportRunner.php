<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 1:08 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRun;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\ReportRunnerReportRunNullReportException;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iReportRunner;
use Cympel\Bundle\ToolsBundle\Services\CympelService;

class ReportRunner extends CympelService implements iReportRunner
{
    protected $doctrine;

    /**
     * @var iCreator
     */
    protected $creator;

    protected $entityManagerName;

    protected $queue;

    protected $reportRunNumber;

    protected $running;

    protected static $offset = 0;

    protected static $offsetIncrement = 1000;

    public function __construct($doctrine, iCreator $creator, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->creator = $creator;
        $this->entityManagerName = $entityManagerName;
        $this->running = false;
        $this->queue = array();
        $this->reportRunNumber = self::$offsetIncrement + self::$offset;
        self::$offset += self::$offsetIncrement;
    }

    /**
     * @param iReportRun $reportRun
     * @return int
     *
     * This method queues a report run to be run, it returns an integer
     * which can be used to query for a report run from the runner using
     * the getReportRunFromQueue method
     */
    public function queueRun(iReportRun $reportRun)
    {
        $reportRun->setReportRunnerQueueNumber($this->reportRunNumber);
        $this->queue[$this->reportRunNumber] = $reportRun;
        $toReturn = $this->reportRunNumber;
        $this->reportRunNumber++;
        $this->run();
        return $toReturn;
    }

    /**
     * @param int $reportRunNumber
     * @return iReportRun
     *
     * The first argument of this method should be an integer that was issued by the queueRun method
     */
    public function getReportRunFromQueue($reportRunNumber)
    {
        return $this->queue[$reportRunNumber];
    }

    /**
     * @return void
     *
     * This method causes the runner's queue to be checked and attempt to process the items in the queue
     * until the queue is empty; if the runner is already running this has no effect
     */
    public function run()
    {
        if(!$this->running) {
            $this->runInternal();
        }
    }

    protected final function runInternal($isRunningLocked = false)
    {
        if(!$isRunningLocked) $this->running = true;

        // If this->running is false don't do anything
        if($this->running) {
            if(count($this->queue) > 0) {
                // Shift the first item in the queue off the queue
                $toRun = array_shift($this->queue);
                // Create a local variable that has the list of callbacks from the ReportRun
                $callbacks = $toRun->getCallbacks();
                // Call the callback function associated with the onRun event
                if($callbacks && is_array($callbacks) && array_key_exists('onRun', $callbacks)) {
                    call_user_func($callbacks['onRun']);
                }
                $report = $toRun->getReport();
                if($report) {
                    $queryBody = $report->getQuery();
                } else {
                    throw new ReportRunnerReportRunNullReportException();
                }


                $em = $this->doctrine->getManager($this->entityManagerName);
                $query = $em->createQuery($queryBody)
                    ->setParameters($toRun->getParameters());
                $result = $query->getResult();

                if($this->isResultValid($result)) {
                    $reportRunResult = $this->creator->create('ReportRunResult');
                    $toRun->setResult($reportRunResult);
                    $reportRunResult->setReportRun($toRun);
                    $reportRunResult->setData($result);
                    if($callbacks && is_array($callbacks) && array_key_exists('onCompletedSuccessfully', $callbacks)) {
                        call_user_func($callbacks['onCompletedSuccessfully']);
                    }
                } else {
                    if($callbacks && is_array($callbacks) && array_key_exists('onCompletedSuccessfully', $callbacks)) {
                        call_user_func($callbacks['onAbend']);
                    }
                }

                // Now check to see if there are more items in the queue
                if(count($this->queue) > 0) {
                    $lockRunning = true;
                    // Prevent the recursion from changing $this->running
                    $this->runInternal($lockRunning);
                }
            }
        }
        if(!$isRunningLocked) $this->running = false;
    }

    protected function isResultValid($result)
    {
        return true;
    }
}