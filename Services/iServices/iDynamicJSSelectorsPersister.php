<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:25 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iDynamicJSSelectorsPersister extends iType
{
    /**
     * @param DynamicJSSelectors $selectors
     * @return void
     */
    public function persist(DynamicJSSelectors $selectors);
}