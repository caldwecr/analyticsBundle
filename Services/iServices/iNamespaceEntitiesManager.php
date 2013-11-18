<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 9:32 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceable;

interface iNamespaceEntitiesManager extends iManager
{
    /**
     * @return iNamespaceEntitiesManagerExtender
     */
    public function getExtender();

    /**
     * @param $key
     * @param iNamespace $cympelNamespace
     * @return iNamespaceable
     */
    public function getNamespaceEntityByCympelNamespaceKey($key, iNamespace $cympelNamespace);
}