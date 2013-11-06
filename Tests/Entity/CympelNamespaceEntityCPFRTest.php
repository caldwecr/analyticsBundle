<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 11:49 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelNamespaceEntityCPFRTest extends ContainerAwareUnitTestCase
{
    public function testCPFR()
    {
        // Create
        $creator = $this->get('cympel_analytics.generics.creator');
        $cne = $creator->create('CympelNamespaceEntity');
        $this->assertEquals('CympelNamespaceEntity', $cne->getType());

        // Persist
        $persister = $this->get('cympel_analytics.generics.persister');

            // We need an entity that implements iNamespaceable so we create one, set its one required property, and persist it
        $ccpt = $creator->create('ConcretePersistableTestType');
        $ccpt->setValue('123');
        $persister->persist($ccpt);

            // We need to tell the CympelNamespaceEntity the type (classAlias) and the id of the iNamespaceable object
        $cne->setPrototypeClassAlias($ccpt->getType());
        $cne->setPrototypeId($ccpt->getId());

            // Validate that prior to being persisted the id is null, then persist and validate that the id property is no longer null
        $cneId = $cne->getId();
        $this->assertNull($cneId);
        $persister->persist($cne);
        $cneId = $cne->getId();
        $cneType = $cne->getType();
        $this->assertNotNull($cneId);

        // Find
        $finder = $this->get('cympel_analytics.generics.finder');
        $cne2 = $finder->findOneByIdAndClassAlias($cneId, $cneType);
        $this->assertNotNull($cne2);
        $this->assertTrue($cne->equals($cne2));

        // Remove
        $remover = $this->get('cympel_analytics.generics.remover');
        $remover->remove($cne);

            // Verify that it can no longer be found
        $cne3 = $finder->findOneByIdAndClassAlias($cneId, $cneType);
        $this->assertNull($cne3);

    }
}