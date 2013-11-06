<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 9:32 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceable;

interface iNamespaceEntitiesManager extends iManager
{
    /**
     * @return iNamespaceEntitiesManagerExtender
     */
    public function getExtender();

    /**
     * @param mixed $key
     * @return iNamespaceable
     */
    public function getNamespaceEntityByCympelNamespaceKey($key);
}