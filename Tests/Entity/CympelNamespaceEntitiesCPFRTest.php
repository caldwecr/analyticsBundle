<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 12:07 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelNamespaceEntitiesCPFRTest extends ContainerAwareUnitTestCase
{
    public function testCPFR()
    {
        // Create
        $creator = $this->get('ca.generics.creator');
        $cn_entities = $creator->create('CympelNamespaceEntities');
        $this->assertEquals('CympelNamespaceEntities', $cn_entities->getType());

        // Persist
        $persister = $this->get('ca.generics.persister');

            // Validate that prior to being persisted the id is null, then persist and validate that the id property is no longer null
        $cn_entitiesId = $cn_entities->getId();
        $this->assertNull($cn_entitiesId);
        $persister->persist($cn_entities);
        $cn_entitiesId = $cn_entities->getId();
        $cn_entitiesType = $cn_entities->getType();
        $this->assertNotNull($cn_entitiesId);


        // Find
        $finder = $this->get('ca.generics.finder');
        $cn_entities2 = $finder->findOneByIdAndClassAlias($cn_entitiesId, $cn_entitiesType);
        $this->assertNotNull($cn_entities2);
        $this->assertTrue($cn_entities->equals($cn_entities2));

        // Remove
        $remover = $this->get('cympel_analytics.generics.remover');
        $remover->remove($cn_entities);

            // Verify that it can no longer be found
        $cn_entities3 = $finder->findOneByIdAndClassAlias($cn_entitiesId, $cn_entitiesType);
        $this->assertNull($cn_entities3);

    }
}