<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:45 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReport;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRun;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRunResult;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidReportRunStatusException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ReportRun
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="ReportRun")
 */
class ReportRun extends CympelType implements iReportRun
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="bigint", nullable=false)
     *
     * This property represents the current status of the ReportRun
     * 0 = new
     * 1 = running
     * 2 = completed_successfully
     * 3 = abend
     *
     * The getter of this property returns the string representation
     * The setter of this property accepts both the string and integer representations
     */
    protected $status;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $parameters;

    /**
     * @var iReport
     * @ORM\ManyToOne(targetEntity="Report", inversedBy="reportRuns", cascade={"persist"})
     * @ORM\JoinColumn(name="report_id", referencedColumnName="id", nullable=false)
     */
    protected $report;

    /**
     * @var iReportRunResult
     * @ORM\OneToOne(targetEntity="ReportRunResult", inversedBy="reportRun")
     * @ORM\JoinColumn(name="result_id", referencedColumnName="id")
     */
    protected $result;

    /**
     * @var int
     * @ORM\Column(type="bigint", nullable=true)
     */
    protected $reportRunnerQueueNumber;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $callbacks;

    /**
     * @var string
     */
    protected static $classAlias = 'ReportRun';

    public function __construct()
    {
        $this->parameters = array();
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        $a = self::areEqual($this, $rightSide);
        $b = true;
        foreach($this->callbacks as $key => $value) {
            $rightSideCallbacks = $rightSide->getCallbacks();
            if($value != $rightSideCallbacks[$key]) {
                $b = false;
            }
        }
        return $a && $b;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $parameterName
     * @param mixed $parameterValue
     * @return void
     */
    public function setParameter($parameterName, $parameterValue)
    {
        $this->parameters[$parameterName] = $parameterName;
    }

    /**
     * @param array $parameters
     * @return void
     */
    public function setParameters($parameters = array())
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        switch($this->status) {
            case 0:
                return 'new';
                break;
            case 1:
                return 'running';
                break;
            case 2:
                return 'completed_successfully';
                break;
            case 3:
                return 'abend';
                break;
            default:
                return 'error_invalid_status';
                break;
        }
    }

    /**
     * @param mixed $status
     * @throws Exception\InvalidReportRunStatusException
     */
    public function setStatus($status)
    {
        if($status && is_int($status) && $status >= 0 && $status <= 3) {
            $this->status = $status;
        } else {
            switch($status) {
                case 'new':
                    $this->status = 0;
                    break;
                case 'running':
                    $this->status = 1;
                    break;
                case 'completed_successfully':
                    $this->status = 2;
                    break;
                case 'abend':
                    $this->status = 3;
                    break;
                default:
                    throw new InvalidReportRunStatusException();
                    break;
            }
        }
    }

    /**
     * @return iReportRunResult
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param iReportRunResult $result
     */
    public function setResult(iReportRunResult $result)
    {
        $this->result = $result;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

    /**
     * @return iReport
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param iReport $report
     * @return void
     */
    public function setReport(iReport $report)
    {
        $this->report = $report;
    }

    /**
     * @param int $reportRunnerQueueNumber
     */
    public function setReportRunnerQueueNumber($reportRunnerQueueNumber)
    {
        $this->reportRunnerQueueNumber = $reportRunnerQueueNumber;
    }

    /**
     * @return int
     */
    public function getReportRunnerQueueNumber()
    {
        return $this->reportRunnerQueueNumber;
    }

    /**
     * @return array
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

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
    ))
    {
        $this->callbacks = array(
            'onRun' => $callbacks['onRun'],
            'onCompletedSuccessfully' => $callbacks['onCompletedSuccessfully'],
            'onAbend' => $callbacks['onAbend'],
        );
    }


}