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

interface iNamespaceEntities extends iType
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
}