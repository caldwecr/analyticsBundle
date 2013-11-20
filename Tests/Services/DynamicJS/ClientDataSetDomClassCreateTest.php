<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 2:12 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ClientDataSetDomClassCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('ca.generics.creator');
        $clientDataSetDomClass = $creator->create('DynamicJSSelectorDomEventClientDataSetDomClass');
        $this->assertEquals('DynamicJSSelectorDomEventClientDataSetDomClass', $clientDataSetDomClass->getType());
    }
}