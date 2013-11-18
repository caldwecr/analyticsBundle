<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/05/13
 * Time: 3:38 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;

interface iNamespaceable extends iType
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

    /**
     * @return int
     */
    public function getId();
}