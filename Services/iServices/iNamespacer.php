<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 3:49 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceable;

interface iNamespacer extends iService
{
    public function addEntityToCympelNamespace(iNamespaceable $entity, iNamespace $cympelNamespace);

    public function removeEntityFromCympelNamespace(iNamespaceable $entity, iNamespace $cympelNamespace);

    public function getEntityByNamespaceKey($key, iNamespace $cympelNamespace);

    public function findOrCreateNamespaceByName($namespaceName);
}