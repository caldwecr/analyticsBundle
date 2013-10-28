<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:02 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;

interface iDynamicJSSelectorPersister extends iType
{
    /**
     * @param DynamicJSSelector $dynamicJSSelector
     * @return void
     */
    public function persist(DynamicJSSelector $dynamicJSSelector);
}