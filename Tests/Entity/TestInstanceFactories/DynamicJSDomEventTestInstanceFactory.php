<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 2:31 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity\TestInstanceFactories;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSDomEvent;

class DynamicJSDomEventTestInstanceFactory
{
    public static function generate()
    {
        $r = new DynamicJSDomEvent();

        return $r;
    }
}