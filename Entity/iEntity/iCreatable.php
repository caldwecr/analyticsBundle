<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:35 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iCreatable extends iNamespaceable, iAliasable
{
    /**
     * @param string $repositoryName
     * @return void
     */
    public function setRepositoryName($repositoryName);

    /**
     * @param string $entityManagerName
     * @return void
     */
    public function setEntityManagerName($entityManagerName);
}