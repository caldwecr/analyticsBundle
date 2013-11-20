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
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iReportRunner;
use Cympel\Bundle\ToolsBundle\Services\CympelService;

class ReportRunner extends CympelService implements iReportRunner
{
    protected $queue;

    protected $reportRunNumber;

    protected $running;

    protected static $offset = 0;

    protected static $offsetIncrement = 1000;

    public function __construct()
    {
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
        $this->run();

        $toReturn = $this->reportRunNumber;
        $this->reportRunNumber++;
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
        // TODO: Implement run() method.
    }

}