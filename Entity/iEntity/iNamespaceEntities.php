<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:20 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;

interface iNamespaceEntities extends iType, iNamespaceable, iPersistable, iFindable, iRemovable, iValidatable
{
    /**
     * @return void
     *
     * Sets the index of the iNamespaceableEntities entity to stale
     */
    public function makeIndexStale();

    /**
     * @return void
     */
    public function refreshIndex();

    /**
     * @param $entitiesArrayCollection
     * @return void
     */
    public function setEntitiesArrayCollection(ArrayCollection $entitiesArrayCollection);

    /**
     * @return ArrayCollection
     */
    public function getEntitiesArrayCollection();

    /**
     * @return int
     */
    public function getEntitiesCount();

    /**
     * @param mixed
     * @return iNamespaceEntity
     */
    public function getEntityByCympelNamespaceKey($key);
}