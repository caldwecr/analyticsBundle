<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:58 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;

interface iDynamicJSSelectorCreator extends iType
{
    /**
     * @return DynamicJSSelector
     */
    public function create();
}