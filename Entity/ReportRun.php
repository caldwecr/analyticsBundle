<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:45 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRun;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRunResult;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;

class ReportRun extends CympelType implements iReportRun
{


    /**
     * @var string
     */
    protected static $classAlias = 'ReportRun';

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        return self::areEqual($this, $rightSide);
    }

    /**
     * @param string $parameterName
     * @param mixed $parameterValue
     * @return void
     */
    public function setParameter($parameterName, $parameterValue)
    {
        // TODO: Implement setParameter() method.
    }

    /**
     * @param array $parameters
     * @return void
     */
    public function setParameters($parameters = array())
    {
        // TODO: Implement setParameters() method.
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        // TODO: Implement getParameters() method.
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        // TODO: Implement getStatus() method.
    }

    /**
     * @param mixed $status
     * @return void
     */
    public function setStatus($status)
    {
        // TODO: Implement setStatus() method.
    }

    /**
     * @return iReportRunResult
     */
    public function getResult()
    {
        // TODO: Implement getResult() method.
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        // TODO: Implement hasValidationConstraints() method.
    }

}