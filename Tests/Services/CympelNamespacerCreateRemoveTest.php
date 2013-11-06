<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:07 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\ConcreteCympelType;

class CympelNamespacerCreateRemoveTest extends ContainerAwareUnitTestCase
{
    public function testCreateRemove()
    {
        $ns = 'testCreateRemove';
        $cn = new CympelNamespace($ns);
        $cct = new ConcreteCympelType();
        $n = $this->get('ca.generics.namespacer');
        $n->addEntityToCympelNamespace($cct, $cn);
        $this->assertEquals(1, $cn->getEntityCount());
        $this->assertEquals($ns, $cct->getCympelNamespace()->getName());
        $n->removeEntityFromCympelNamespace($cct, $cn);
        $this->assertEquals(0, $cn->getEntityCount());
        $this->assertTrue(CympelNamespace::getBlankCympelNamespace()->equals($cct->getCympelNamespace()));


    }
}