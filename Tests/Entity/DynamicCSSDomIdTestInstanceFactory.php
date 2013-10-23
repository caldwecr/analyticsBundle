<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 3:19 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomId;

class DynamicCSSDomIdTestInstanceFactory
{
    public static function createInstance($domIdValue = 'validValue')
    {
        $dcss = new DynamicCSS();
        $dcdi = new DynamicCSSDomId();
        $dcss->setDynamicCSSDomIds(array($dcdi));
        $dcdi->setRendered(0);
        $dcdi->setDomIdValue($domIdValue);
        $dcdi->setDynamicCSS($dcss);
        $dcdi->setCreated(time());
        return $dcdi;
    }
}