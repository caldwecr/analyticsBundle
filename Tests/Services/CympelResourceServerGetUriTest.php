<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 11:15 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelResourceServerGetUriTest extends ContainerAwareUnitTestCase
{
    public function testGetUri()
    {
        $s = $this->get('ca.generics.resource_server');
        $uri = $s->getUri('testImage.png');
        $this->assertNotNull($uri);
    }
}