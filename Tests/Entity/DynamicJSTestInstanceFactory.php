<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:36 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;
use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;

class DynamicJSTestInstanceFactory
{
    public static function generate()
    {
        $t = new Tracker();
        $i = new DynamicJS();
        $ac = new ArrayCollection(array($i));
        $t->setTrackingTools($ac);
        return $i;
    }
}