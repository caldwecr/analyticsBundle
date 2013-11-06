<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 12:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelNamespacerGetEntityByNamespaceKeyTest extends ContainerAwareUnitTestCase
{
    public function testGetEntity()
    {
        // Attach to services

        $creator = $this->get('cympel_analytics.generics.creator');
        $finder = $this->get('cympel_analytics.generics.finder');
        $namespacer = $this->get('ca.generics.namespacer');
        $persister = $this->get('cympel_analytics.generics.persister');

        // Create the test entity and initialize required properties
        $c = $creator->create('ConcretePersistableTestType');
        $c->setValue('pretend');
        $this->assertNotNull($c);
        $this->assertEquals('ConcretePersistableTestType', $c->getType());

        // Persist the test entity
        $persister->persist($c);
        $this->assertNotNull($c->getId());

        // Create the test namespace and initialize required properties
        $ns = $creator->create('CympelNamespace');
        $nsName = 'testGetEntity';
        $nsCreated = time();
        $nsDescription = 'a fake namespace used for testing entity retrieval from a namespace';
        $ns->setName($nsName);
        $ns->setCreated($nsCreated);
        $ns->setDescription($nsDescription);

        // Add the test entity to the namespace
        $namespacer->addEntityToCympelNamespace($c, $ns);

        // Store the test entity's namespace key
        $cNamespaceKey = $c->getCympelNamespaceKey();
        $this->assertNotNull($cNamespaceKey);

        // Persist the namespace
        $persister->persist($ns);

        // Store the namespace's id
        $nsId = $ns->getId();
        $this->assertNotNull($nsId);

        // Find the namespace
        $ns2 = $finder->findOneByIdAndClassAlias($nsId, 'CympelNamespace');
        $this->assertNotNull($ns2);
        $this->assertTrue($ns->equals($ns2));

        // Get the entity from the stored namespace key
        $c2 = $namespacer->getEntityByNamespaceKey($cNamespaceKey, $ns);
        $this->assertNotNull($c2);
        $this->assertTrue($c->equals($c2));
    }
}