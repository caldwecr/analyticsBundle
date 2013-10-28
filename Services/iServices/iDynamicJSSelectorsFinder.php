<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:22 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;

interface iDynamicJSSelectorsFinder extends iType
{
    /**
     * @param int $id
     * @return DynamicJSSelectors
     */
    public function findOneById($id);
}