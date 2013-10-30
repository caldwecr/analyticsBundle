<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 2:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iDynamicJSSelectors extends iCreatable, iPersistable, iFindable, iRemovable
{
    /**
     * @return iDynamicJS
     */
    public function getDynamicJ();
}