<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:30 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iPersistable
{
    /**
     * @return string
     */
    public function getRepositoryName();

    /**
     * @return string
     */
    public function getEntityManagerName();
}