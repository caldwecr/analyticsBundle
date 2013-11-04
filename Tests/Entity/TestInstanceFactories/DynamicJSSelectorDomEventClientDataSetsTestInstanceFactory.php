<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 2:40 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity\TestInstanceFactories;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSets;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;

class DynamicJSSelectorDomEventClientDataSetsTestInstanceFactory
{
    public static function generate(iDynamicJSSelectorDomEvent $selectorDomEvent = null)
    {
        $r = new DynamicJSSelectorDomEventClientDataSets();
        if(!$selectorDomEvent) {
            $selectorDomEvent = DynamicJSSelectorDomEventTestInstanceFactory::generate();
        }
        $r->setSelectorDomEvent($selectorDomEvent);
        return $r;
    }
}