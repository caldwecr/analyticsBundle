<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:28 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iNamespaceEntity extends iNamespaceable, iPersistable, iFindable, iRemovable, iValidatable
{
    /**
     * @return string
     */
    public function getPrototypeClassAlias();

    /**
     * @param string $prototypeClassAlias
     * @return void
     */
    public function setPrototypeClassAlias($prototypeClassAlias);

    /**
     * @return int
     */
    public function getPrototypeId();

    /**
     * @param int $prototypeId
     * @return void
     */
    public function setPrototypeId($prototypeId);
}