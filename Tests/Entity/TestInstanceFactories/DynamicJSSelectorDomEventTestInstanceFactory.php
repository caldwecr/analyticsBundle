<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 2:22 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity\TestInstanceFactories;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;

class DynamicJSSelectorDomEventTestInstanceFactory
{
    public static function generate(iDynamicJSSelector $selector = null, iDynamicJSDomEvent $domEvent = null)
    {
        $r = new DynamicJSSelectorDomEvent();
        if(!$domEvent) {
            $domEvent = DynamicJSDomEventTestInstanceFactory::generate();
        }
        if(!$selector) {
            $selector = DynamicJSSelectorTestInstanceFactory::generate();
        }
        $r->setDomEvent($domEvent);
        $r->setSelector($selector);
        $r->setEntityManagerName('cympelanalytics');
        $r->setRepositoryName('CympelAnalyticsBundle:DynamicJSSelectorDomEvent');
        return $r;
    }
}