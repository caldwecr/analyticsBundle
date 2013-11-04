<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 9:16 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;

interface iDynamicJSSelectorDomEventManager extends iCreate, iPersist, iFind, iRemove, iValidate
{
    /**
     * @param iDynamicJSSelector $selector
     * @param iDynamicJSDomEvent $domEvent
     * @param $key
     * @param $json
     * @return iDynamicJSSelectorDomEvent
     */
    public function captureClientDataSet(iDynamicJSSelector $selector, iDynamicJSDomEvent $domEvent, $key, $json);
}