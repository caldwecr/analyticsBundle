<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 9:33 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceEntity;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceEntities;

interface iNamespaceEntitiesManagerExtender extends iExtender
{
    public function appendEntity(iNamespaceEntities $entities, iNamespaceEntity $entity);

    public function removeEntity(iNamespaceEntities $entities, iNamespaceEntity $entity);
}