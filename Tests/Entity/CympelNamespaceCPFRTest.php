<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 12:38 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelNamespaceCPFRTest extends ContainerAwareUnitTestCase
{
    public function testCPFR()
    {
        // Create
        $creator = $this->get('ca.generics.creator');
        $cn = $creator->create('CympelNamespace');
        $this->assertEquals('CympelNamespace', $cn->getType());

        // Persist
        $persister = $this->get('ca.generics.persister');

            // Set required properties of the CympelNamespace
        $cn->setCreated(time());
        $cn->setDescription('test namespace for testing cpfr of CympelNamespace');

            // Validate that prior to being persisted the id is null, then persist and validate that the id property is no longer null
        $cnId = $cn->getId();
        $this->assertNull($cnId);
        $persister->persist($cn);
        $cnId = $cn->getId();
        $cnType = $cn->getType();
        $this->assertNotNull($cnId);

        // Find
        $finder = $this->get('ca.generics.finder');
        $cn2 = $finder->findOneByIdAndClassAlias($cnId, $cnType);
        $this->assertNotNull($cn2);
        $this->assertTrue($cn->equals($cn2));

        // Remove
        $remover = $this->get('cympel_analytics.generics.remover');
        $remover->remove($cn);

        // Verify that it can no longer be found
        $cn3 = $finder->findOneByIdAndClassAlias($cnId, $cnType);
        $this->assertNull($cn3);

    }
}