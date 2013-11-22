<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 12:11 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSManagerGenerateOneTimeTest extends ContainerAwareUnitTestCase
{
    public function testDynamicCSSManagerGenerateOneTime()
    {
        $dcm = $this->get('ca.dcss.manager');
        $ids = array(
            'foo',
            'bar'
        );
        $pseudo = 'hover';
        $uri = $dcm->generateOneTimeStylesheet($ids, $pseudo, $this->get('service_container')->getParameter('cympel_analytics.namespace'));

        $this->assertTrue(strpos($uri, '/analytics/dynamic/css/') !== false);
    }
}