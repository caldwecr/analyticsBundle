<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:36 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;

/**
 * Interface iReportRunResult
 * @package Cympel\Bundle\AnalyticsBundle\Entity\iEntity
 */
interface iReportRunResult extends iPersistable, iFindable, iRemovable, iValidatable, iCreatable
{
    /**
     * @return array
     */
    public function toArray();

    /**
     * @return iReportRun
     */
    public function getReportRun();

    /**
     * @param iReportRun $reportRun
     * @return void
     */
    public function setReportRun(iReportRun $reportRun);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @return array
     */
    public function getData();

    /**
     * @param array $data
     * @return void
     */
    public function setData($data = array());
}