<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:20 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iNamespaceableEntities extends iType
{
    /**
     * @param array $criteria
     * @return iNamespaceable
     */
    public function findEntityBy($criteria = array());

    /**
     * @param iNamespaceable $entity
     * @return void
     */
    public function addEntity(iNamespaceable $entity);

    /**
     * @param iNamespaceable $entity
     * @return void
     */
    public function removeEntity(iNamespaceable $entity);

    /**
     * @return int
     */
    public function getEntityCount();
}