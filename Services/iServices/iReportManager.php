<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/21/13
 * Time: 12:57 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReport;

interface iReportManager extends iManager
{
    /**
     * @param string $reportName
     * @param string|null $reportQuery
     * @return iReport
     * @throws \Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnableToGetReportException
     * @throws \Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnknownReportAndBlankQueryException
     */
    public function findOrCreateReport($reportName, $reportQuery = null);

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
    );

    /**
     * @return iReportRunner
     */
    public function getReportRunner();
}