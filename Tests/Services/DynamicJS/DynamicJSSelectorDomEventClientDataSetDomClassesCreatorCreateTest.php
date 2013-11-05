<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 7:31 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEventClientDataSet;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorDomEventClientDataSetDomClassesCreatorCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('cympel_analytics.cds.dom_classes.creator');

        $encodeMe = array(
            'clientX' => 50,
            'clientY' => 25,
            'classList' => array(
                '0' => 'firstClass',
                '1' => 'secondClass',
                'length' => 2
            ),
            'id' => 'number_three',
            'outerHTML' => '<div>somefoo</div>',
            'eventType' => 'click'
        );
        $json = json_encode($encodeMe);
        $dataSet = new DynamicJSSelectorDomEventClientDataSet();
        $dataSet->setEntityManagerName('cympelanalytics');
        $dataSet->setRepositoryName('CympelAnalyticsBundle:DynamicJSSelectorDomEventClientDataSet');
        $classAlias = 'DynamicJSSelectorDomEventClientDataSetDomClass';
        $classesAlias = 'DynamicJSSelectorDomEventClientDataSetDomClasses';
        $classes = $creator->createClassesFromJSONAndDataSet($json, $dataSet, $classAlias, $classesAlias);
        $this->assertNotNull($classes);
    }
}