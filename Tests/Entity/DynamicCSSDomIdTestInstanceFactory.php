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
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomIdArrayCollection;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;

class DynamicCSSDomIdTestInstanceFactory
{
    public static function createInstance($domIdValue = 'validValue', iCreator $creator = null)
    {
        if($creator) {
            $dcss = $creator->create('DynamicCSS');
            $dcdi = $creator->create('DynamicCSSDomId');
        } else {
            $dcss = new DynamicCSS();
            $dcdi = new DynamicCSSDomId();
        }
        $ids = new DynamicCSSDomIdArrayCollection(array($dcdi));
        $dcss->setDynamicCSSDomIds($ids);
        $dcdi->setRendered(0);
        $dcdi->setDomIdValue($domIdValue);
        $dcdi->setDynamicCSS($dcss);
        $dcdi->setCreated(time());
        return $dcdi;
    }
}