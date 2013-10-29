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
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $ids = array(
            'foo',
            'bar'
        );
        $pseudo = 'hover';
        $uri = $dcm->generateOneTimeStylesheet('DynamicCSS', $ids, $pseudo);

        $this->assertTrue(strpos($uri, '/analytics/dynamic/css/') !== false);
    }
}