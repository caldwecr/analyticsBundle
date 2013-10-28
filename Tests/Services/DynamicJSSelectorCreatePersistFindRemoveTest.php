<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:20 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicJSSelectorsTestInstanceFactory;

class DynamicJSSelectorCreatePersistFindRemoveTest extends ContainerAwareUnitTestCase
{
    public function testCreatePersistFindRemove()
    {
        $creator = $this->get('cympel_analytics.dynamic_js_selector_creator');
        $persister = $this->get('cympel_analytics.dynamic_js_selector_persister');
        $finder = $this->get('cympel_analytics.dynamic_js_selector_finder');
        $remover = $this->get('cympel_analytics.dynamic_js_selector_remover');

        $djss = DynamicJSSelectorsTestInstanceFactory::generate();
        $dynamicJSSelector = $creator->create();
        $dynamicJSSelector->setSelection("#foobar");
        $dynamicJSSelector->setParentSelectors($djss);
        $dynamicJSSelector->setCreated(time());
        $dynamicJSSelector->setCalled(0);

        $persister->persist($dynamicJSSelector);

        $id = $dynamicJSSelector->getId();

        $dynamicJSSelector2 = $finder->findOneById($id);

        $this->assertTrue($dynamicJSSelector->equals($dynamicJSSelector2));
        $this->assertTrue($dynamicJSSelector2->equals($dynamicJSSelector));

        $remover->remove($dynamicJSSelector);

        $dynamicJSSelector3 = $finder->findOneById($id);
        $this->assertNull($dynamicJSSelector3);
    }
}