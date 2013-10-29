<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 1:49 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSManagerRenderDCSSByIdTest extends ContainerAwareUnitTestCase
{
    public function testRenderDCSS()
    {
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $ids = array(
            'boo',
            'hoo'
        );
        $pseudo = 'visited';
        $uri = $dcm->generateOneTimeStylesheet('DynamicCSS', $ids, $pseudo);

        $uri_prefix = '/analytics/dynamic/css/';
        $this->assertTrue(strpos($uri, $uri_prefix) !== false);
        $id = str_replace($uri_prefix, '', $uri);

        $dcm->renderById('DynamicCSS', $id);

        $dcss = $dcm->findOneTimeStylesheetById('DynamicCSS', $id);
        $this->assertNotEquals(0, $dcss->getRendered());
    }
}