<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 9:32 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

interface iNamespaceEntitiesManager extends iManager
{
    /**
     * @return iNamespaceableEntitiesManagerExtender
     */
    public function getExtender();

    /**
     * @param mixed $key
     * @return void
     */
    public function getNamespaceEntityByCympelNamespaceKey($key);
}