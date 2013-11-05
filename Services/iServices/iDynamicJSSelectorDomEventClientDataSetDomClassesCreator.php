<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 7:17 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSet;

interface iDynamicJSSelectorDomEventClientDataSetDomClassesCreator extends iCreator
{
    public function createClassesFromJSONAndDataSet($json, iDynamicJSSelectorDomEventClientDataSet $dataSet, $classAlias, $classesAlias);
}