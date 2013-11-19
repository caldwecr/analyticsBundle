<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:55 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;
use Cympel\Bundle\ToolsBundle\Services\iServices\iService;

interface iManage extends iService
{
    /**
     * @return iManager
     */
    public function getManager();
}