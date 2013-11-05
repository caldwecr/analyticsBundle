<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:28 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;

interface iFinder extends iType
{
    /**
     * @param string $id
     * @param string $classAlias
     * @return iFindable
     */
    public function findOneByIdAndClassAlias($id, $classAlias);
}