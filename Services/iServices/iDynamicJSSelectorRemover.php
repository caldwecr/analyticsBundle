<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:04 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;

interface iDynamicJSSelectorRemover extends iType
{
    /**
     * @param DynamicJSSelector $selector
     * @return void
     */
    public function remove(DynamicJSSelector $selector);
}