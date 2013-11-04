<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 10:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;

interface iDynamicJSSelectorDomEventFinder extends iFinder
{
    /**
     * @param iDynamicJSSelector $selector
     * @param iDynamicJSDomEvent $domEvent
     * @param string $classAlias
     * @return iDynamicJSSelectorDomEvent
     * @throws \Cympel\Bundle\AnalyticsBundle\Services\Exception\UnpersistedFindByException
     */
    public function findOneBySelectorAndDomEvent(iDynamicJSSelector $selector, iDynamicJSDomEvent $domEvent, $classAlias);
}