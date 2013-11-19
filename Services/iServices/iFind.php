<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 9:18 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;
use Cympel\Bundle\ToolsBundle\Services\iServices\iService;

interface iFind extends iService
{
    /**
     * @return iFinder
     */
    public function getFinder();
}