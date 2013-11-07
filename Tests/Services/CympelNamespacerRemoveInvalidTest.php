<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 7:54 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToRemoveCympelNamespaceException;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelNamespacerRemoveInvalidTest extends ContainerAwareUnitTestCase
{
    public function testRemoveInvalid()
    {
        $container = $this->get('service_container');;
        $nsName = $container->getParameter('cympel_analytics.namespace');
        $ns_name = $nsName;
        $ns2_name = 'anotherTestRemoveInvalid';
        $namespacer = $this->get('ca.generics.namespacer');
        $ns = $this->get('cympel_analytics.generics.creator')->create('CympelNamespace');
        $ns2 = $this->get('cympel_analytics.generics.creator')->create('CympelNamespace');
        $ns->setName($ns_name);
        $ns2->setName($ns2_name);
        $entity = $this->get('cympel_analytics.generics.creator')->create('ConcretePersistableTestType');
        $entity->setValue('testRemove');

        // You can't remove an entity from a namespace if it doesn't belong to one
        $e = null;
        try {
            $namespacer->removeEntityFromCympelNamespace($entity, $ns);
        } catch (InvalidAttemptToRemoveCympelNamespaceException $e) {

        }
        $this->assertNotNull($e);

        // You can't remove an entity from a namespace if it doesn't belong to that namespace (for instance it belongs to a different namespace)
        $this->get('cympel_analytics.generics.persister')->persist($entity);
        $namespacer->addEntityToCympelNamespace($entity, $ns);
        $this->assertTrue($ns->equals($entity->getCympelNamespace()));
        $this->assertFalse($ns2->equals($entity->getCympelNamespace()));
        $e = null;
        try {
            $namespacer->removeEntityFromCympelNamespace($entity, $ns2);
        } catch (InvalidAttemptToRemoveCympelNamespaceException $e) {

        }
        $this->assertNotNull($e);

        // Validate that you can remove the entity from the namespace to which it belongs
        $e = null;
        try {
            $namespacer->removeEntityFromCympelNamespace($entity, $ns);
        } catch (\Exception $e) {

        }
        $this->assertNull($e);

    }
}