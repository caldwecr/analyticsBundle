<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 1:59 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iAliasable extends iNamespaceable
{
    /**
     * @return string
     */
    public static function getClassAlias();

    /**
     * @param $classAlias
     * @return void
     */
    public static function setClassAlias($classAlias);
}