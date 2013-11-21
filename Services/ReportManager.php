<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/21/13
 * Time: 1:04 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReport;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iReportRunner;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iReportManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnknownReportAndBlankQueryException;
use Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnableToGetReportException;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;

class ReportManager extends CympelManager implements iReportManager
{
    /**
     * @var iReportRunner
     */
    protected $reportRunner;

    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iNamespacer $namespacer
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iValidator $validator
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iNamespacer $namespacer, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->validator = $validator;
        $this->namespacer = $namespacer;
        $this->processExtension($extender);
    }

    /**
     * @param string $reportName
     * @param string|null $reportQuery
     * @return iReport
     * @throws \Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnableToGetReportException
     * @throws \Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnknownReportAndBlankQueryException
     */
    public function findOrCreateReport($reportName, $reportQuery = null)
    {
        $report = $this->getFinder()->findOneByPropertyAndClassAlias(
            array(
                'name' => $reportName,
            ),
            'Report'
        );
        if(!$report) {
            if(!$reportQuery) {
                throw new UnknownReportAndBlankQueryException();
            }
            // The report doesn't exist in the database so create it and persist it
            $report = $this->getCreator()->create('Report');
            $report->setName($reportName);
            $report->setQuery($reportQuery);
            $this->getPersister()->persist($report);
        }
        if(!$report) {
            throw new UnableToGetReportException();
        }
        return $report;
    }

    /**
     * @param iReport $report
     * @param array &$results
     * @param array $parameters
     * @param array $callbacks
     * @return mixed
     *
     * * The callbacks will usually be of the form
     *  $callbacks = array(
     *      'onRun' => array(objectInstance, methodName),
     *      'onCompletedSuccessfully' => array(objectInstance, methodName),
     *      'onAbend' => array(objectInstance, methodName)
     * );
     *
     * For more information on options reference
     * @link http://us2.php.net/call_user_func
     */
    public function queueReport(
        iReport $report,
        &$results = array(),
        $parameters = array(),
        $callbacks = array(
            'onRun' => null,
            'onCompletedSuccessfully' => null,
            'onAbend' => null,
        )
    )
    {
        $reportRun = $this->getCreator()->create('ReportRun');

        $report->addRun($reportRun);
        $reportRun->setStatus('new');
        $reportRun->setParameters($parameters);
        $reportRun->setReport($report);
        $reportRun->setCallbacks($callbacks);

        $reportRunNumber = $this->getReportRunner()->queueRun($reportRun);
        $results = $reportRun->getResult()->getData();
    }

    /**
     * @param iExtender $extension
     */
    public function processExtension(iExtender $extension)
    {
        $this->captureReportRunner($extension);
    }

    /**
     * @param iReportRunner $reportRunner
     */
    protected final function captureReportRunner(iReportRunner $reportRunner)
    {
        $this->reportRunner = $reportRunner;
    }

    /**
     * @return iReportRunner
     */
    public function getReportRunner()
    {
        return $this->reportRunner;
    }

}