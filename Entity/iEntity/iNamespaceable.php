<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/05/13
 * Time: 3:38 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iNamespaceable extends iType, iCreatable
{
    /**
     * @param iNamespace $cympelNamespace
     * @return void
     */
    public function setCympelNamespace(iNamespace $cympelNamespace);

    /**
     * @return iNamespace
     */
    public function getCympelNamespace();

    /**
     * @param string $key
     * @return void
     */
    public function setCympelNamespaceKey($key);

    /**
     * @return string
     */
    public function getCympelNamespaceKey();
}