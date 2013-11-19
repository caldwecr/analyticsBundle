<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 10:29 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\ToolsBundle\Services\CympelService;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceEntities;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceEntity;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespaceEntitiesManagerExtender;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;

class CympelNamespaceEntitiesManagerExtender extends CympelService implements iNamespaceEntitiesManagerExtender
{
    /**
     * @var string
     */
    protected static $classAlias = 'CympelNamespaceEntitiesManagerExtender';

    public function appendEntity(iNamespaceEntities $entities, iNamespaceEntity $entity)
    {
        $ac = $entities->getEntitiesArrayCollection();
        $ac->set($entity->getCympelNamespaceKey(), $entity);
    }

    public function removeEntity(iNamespaceEntities $entities, iNamespaceEntity $entity)
    {
        $ac = $entities->getEntitiesArrayCollection();
        $ac->remove($entity->getCympelNamespaceKey());
    }

    /**
     * @param $key
     * @param iNamespace $cympelNamespace
     * @return iNamespaceEntity
     */
    public function getNamespaceEntityByCympelNamespaceKey($key, iNamespace $cympelNamespace)
    {
        $entities = $cympelNamespace->getEntities();
        $cympelNamespaceEntity = $entities->getEntityByCympelNamespaceKey($key);
        return $cympelNamespaceEntity;
    }
}