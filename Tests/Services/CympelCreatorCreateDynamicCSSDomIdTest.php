<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/22/13
 * Time: 2:11 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelCreatorCreateDynamicCSSDomIdTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('ca.generics.creator');
        $e = $creator->create('DynamicCSSDomId');
        $this->assertEquals('DynamicCSSDomId', $e->getType());
    }
}