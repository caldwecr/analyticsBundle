<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 2:22 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ConcretePersistableTestTypeClassAliasRegistrarTest extends ContainerAwareUnitTestCase
{
    public function testAliasRegistration()
    {
        $c = $this->get('ca.generics.creator')->create('ConcretePersistableTestType');
        $this->assertEquals('ConcretePersistableTestType', $c->getType());
    }
}