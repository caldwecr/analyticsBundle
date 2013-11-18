<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 8:09 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;

interface iDynamicJSSelectorDomEvent extends iFindable, iPersistable, iRemovable, iCreatable, iValidatable
{
    /**
     * @return iDynamicJSSelectorDomEventClientDataSets
     */
    public function getClientDataSets();

    /**
     * @param iDynamicJSSelectorDomEventClientDataSets $clientDataSets
     * @return void
     */
    public function setClientDataSets(iDynamicJSSelectorDomEventClientDataSets $clientDataSets);
}