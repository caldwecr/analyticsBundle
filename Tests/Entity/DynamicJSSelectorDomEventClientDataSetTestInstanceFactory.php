<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 9:56 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSets;

class DynamicJSSelectorDomEventClientDataSetTestInstanceFactory
{
    public static function generate(iDynamicJSSelectorDomEventClientDataSets $parentDataSets = null)
    {
        $i = new DynamicJSSelectorDomEventClientDataSet();
        $i->setParentDataSets($parentDataSets);
        $i->setRepositoryName('CympelAnalyticsBundle:DynamicJSSelectorDomEventClientDataSet');
        $i->setEntityManagerName('cympelanalytics');
        $i->setClientDomElementId('someId');
        $i->setClientEventType('click');
        $i->setClientOuterHTML("<div id=\"someId\">foobar</div>");
        $i->setClientX(0);
        $i->setClientY(1);
        return $i;
    }
}