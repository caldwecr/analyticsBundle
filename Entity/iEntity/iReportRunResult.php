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
}