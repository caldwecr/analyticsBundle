<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:39 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iCreatableAndFindable;

interface iCreator extends iType
{
    /**
     * @param string $classAlias
     * @return iCreatableAndFindable
     */
    public function create($classAlias);
}