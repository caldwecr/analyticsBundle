<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 8:36 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;

interface iRemover extends iType
{
    /**
     * @param iRemovable $removable
     * @return void
     */
    public function remove(iRemovable $removable);

    /**
     * @param Object $doctrine - the doctrine service
     * @param iNamespacer $namespacer
     * @param string $namespaceName
     */
    public function __construct($doctrine, iNamespacer $namespacer, $namespaceName = '_blank');
}