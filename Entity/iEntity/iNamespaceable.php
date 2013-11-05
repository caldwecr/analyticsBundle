<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/05/13
 * Time: 3:38 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iNamespaceable extends iType
{
    /**
     * @param string $cympelNamespace
     * @return void
     */
    public function setCympelNamespace($cympelNamespace);

    /**
     * @return string
     */
    public function getCympelNamespace();
}