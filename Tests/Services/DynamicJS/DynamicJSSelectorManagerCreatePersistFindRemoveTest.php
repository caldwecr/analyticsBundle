<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:10 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicJSSelectorsTestInstanceFactory;

class DynamicJSSelectorManagerCreatePersistFindRemoveTest extends ContainerAwareUnitTestCase
{
    public function test()
    {
        $manager = $this->get('ca.djs.selector.manager');
        $creator = $manager->getCreator();
        $persister = $manager->getPersister();
        $finder = $manager->getFinder();
        $remover = $manager->getRemover();

        $djss = DynamicJSSelectorsTestInstanceFactory::generate();
        $dynamicJSSelector = $creator->create('DynamicJSSelector');
        $dynamicJSSelector->setSelection("#foobar");
        $dynamicJSSelector->setParentSelectors($djss);
        $dynamicJSSelector->setCreated(time());
        $dynamicJSSelector->setCalled(0);

        $persister->persist($dynamicJSSelector);

        $id = $dynamicJSSelector->getId();

        $dynamicJSSelector2 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSSelector');

        $this->assertTrue($dynamicJSSelector->equals($dynamicJSSelector2));
        $this->assertTrue($dynamicJSSelector2->equals($dynamicJSSelector));

        // Now modify 2 and persist it
        $dynamicJSSelector2->setSelection("#foobaz");

        $persister->persist($dynamicJSSelector2);




        $remover->remove($dynamicJSSelector);

        $dynamicJSSelector3 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSSelector');
        $this->assertNull($dynamicJSSelector3);
    }
}