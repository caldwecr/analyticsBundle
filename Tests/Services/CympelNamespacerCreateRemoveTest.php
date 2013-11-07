<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:07 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\ConcretePersistableTestType;
use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelNamespacerCreateRemoveTest extends ContainerAwareUnitTestCase
{
    public function testCreateRemove()
    {
        $container = $this->get('service_container');
        $nsName = $container->getParameter('cympel_analytics.namespace');

        $cn = new CympelNamespace($nsName);
        $ccpt = $this->get('cympel_analytics.generics.creator')->create('ConcretePersistableTestType');
        $ccpt->setValue('something');
        $this->get('cympel_analytics.generics.persister')->persist($ccpt);
        $n = $this->get('ca.generics.namespacer');
        $n->addEntityToCympelNamespace($ccpt, $cn);
        $this->assertEquals(1, $cn->getEntityCount());
        $this->assertEquals($nsName, $ccpt->getCympelNamespace()->getName());
        $n->removeEntityFromCympelNamespace($ccpt, $cn);
        $this->assertEquals(0, $cn->getEntityCount());
        $this->assertTrue(CympelNamespace::getBlankCympelNamespace()->equals($ccpt->getCympelNamespace()));


    }
}