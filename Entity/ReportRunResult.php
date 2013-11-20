<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 11:51 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRun;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRunResult;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ReportRunResult
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="ReportRunResult")
 */
class ReportRunResult extends CympelType implements iReportRunResult
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     */
    protected $id;

    /**
     * @var iReportRun
     * @ORM\OneToOne(targetEntity="ReportRun", mappedBy="result")
     */
    protected $reportRun;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     */
    protected $created;

    /**
     * @var array
     * @ORM\Column(type="array")
     *
     * This array stores the actual result data
     */
    protected $data;

    /**
     * @var string
     */
    protected static $classAlias = 'ReportRunResult';

    public function __construct()
    {
        $this->created = time();
        $this->data = array();
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        self::areEqual($this, $rightSide);
    }

    /**
     * @return array
     *
     * This method is an alias of getData
     */
    public function toArray()
    {
        return $this->getData();
    }

    /**
     * @return iReportRun
     */
    public function getReportRun()
    {
        return $this->reportRun;
    }

    /**
     * @param iReportRun $reportRun
     * @return void
     */
    public function setReportRun(iReportRun $reportRun)
    {
        $this->reportRun = $reportRun;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return void
     */
    public function setData($data = array())
    {
        $this->data = $data;
    }

}