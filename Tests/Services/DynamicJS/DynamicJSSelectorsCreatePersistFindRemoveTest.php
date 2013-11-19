<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:25 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorsCreatePersistFindRemoveTest extends ContainerAwareUnitTestCase
{
    public function testCreatePersistFindRemove()
    {
        $manager = $this->get('ca.djs.selectors.manager');
        $creator = $manager->getCreator();
        $finder = $manager->getFinder();
        $persister = $manager->getPersister();
        $remover = $manager->getRemover();

        $d = $creator->create('DynamicJSSelectors');

        $this->assertEquals('DynamicJSSelectors', $d->getType());

        $persister->persist($d);

        $id = $d->getId();
        $d2 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSSelectors');

        $this->assertTrue($d->equals($d2));

        $remover->remove($d2);

        $d3 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSSelectors');

        $this->assertNull($d3);
    }
}