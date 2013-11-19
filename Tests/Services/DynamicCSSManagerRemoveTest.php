<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 1:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSManagerRemoveTest extends ContainerAwareUnitTestCase
{
    public function testRemove()
    {
        $dcm = $this->get('ca.dcss.manager');
        $ids = array(
            'baz',
            'buz'
        );
        $pseudo = 'clicked';
        $uri = $dcm->generateOneTimeStylesheet($ids, $pseudo);

        $uri_prefix = '/analytics/dynamic/css/';
        $this->assertTrue(strpos($uri, $uri_prefix) !== false);
        $id = str_replace($uri_prefix, '', $uri);

        $dcss = $dcm->findOneTimeStylesheetById('DynamicCSS', $id);

        $this->assertEquals('DynamicCSS', $dcss->getType());

        $dcm->getRemover()->remove($dcss);

        $dcss2 = $dcm->findOneTimeStylesheetById('DynamicCSS', $id);

        $this->assertNull($dcss2);

    }
}