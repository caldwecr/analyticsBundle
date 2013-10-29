<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:16 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelCreatorCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('cympel_analytics.generics.creator');
        $cp = $creator->create('ConcretePersistableTestType');
        $this->assertEquals('ConcretePersistableTestType', $cp->getType());
    }
}