<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 8:09 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

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