<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:32 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;

/**
 * Interface iReportRun
 * @package Cympel\Bundle\AnalyticsBundle\Entity\iEntity
 */
interface iReportRun extends iPersistable, iFindable, iRemovable, iValidatable, iCreatable
{
    /**
     * @param string $parameterName
     * @param mixed $parameterValue
     * @return void
     */
    public function setParameter($parameterName, $parameterValue);

    /**
     * @param array $parameters
     * @return void
     */
    public function setParameters($parameters = array());

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param mixed $status
     * @return void
     */
    public function setStatus($status);

    /**
     * @return iReportRunResult
     */
    public function getResult();

    /**
     * @param iReportRunResult $result
     * @return void
     */
    public function setResult(iReportRunResult $result);

    /**
     * @return iReport
     */
    public function getReport();

    /**
     * @param iReport $report
     * @return void
     */
    public function setReport(iReport $report);

    /**
     * @param int $reportRunnerQueueNumber
     */
    public function setReportRunnerQueueNumber($reportRunnerQueueNumber);

    /**
     * @return int
     */
    public function getReportRunnerQueueNumber();

    /**
     * @return array
     */
    public function getCallbacks();

    /**
     * @param array $callbacks
     * @return void
     *
     * The callbacks will usually be of the form
     *  $callbacks = array(
     *      'onRun' => array(objectInstance, methodName),
     *      'onCompletedSuccessfully' => array(objectInstance, methodName),
     *      'onAbend' => array(objectInstance, methodName)
     * );
     *
     * For more information on options reference
     * @link http://us2.php.net/call_user_func
     */
    public function setCallbacks($callbacks = array(
        'onRun' => null,
        'onCompletedSuccessfully' => null,
        'onAbend' => null,
    ));
}