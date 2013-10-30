<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:27 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectors;

interface iDynamicJSSelectorsManager extends iCreate, iFind, iPersist, iRemove
{
    /**
     * @param array $selectorArray
     * @return iDynamicJSSelectors
     */
    public function createFromArray($selectorArray);
}