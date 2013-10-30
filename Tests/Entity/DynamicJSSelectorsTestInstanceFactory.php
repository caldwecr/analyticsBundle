<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:40 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;

class DynamicJSSelectorsTestInstanceFactory
{
    public static function generate()
    {
        $dj = DynamicJSTestInstanceFactory::generate();
        $dynamicJSSelectors = new DynamicJSSelectors();
        $dynamicJSSelectors->setCreated(time());
        $dynamicJSSelectors->setDynamicJ($dj);
        return $dynamicJSSelectors;

    }
}