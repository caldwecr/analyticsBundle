<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 2:33 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity\TestInstanceFactories;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;

class DynamicJSSelectorTestInstanceFactory
{
    public static function generate()
    {
        $r = new DynamicJSSelector();
        return $r;
    }
}