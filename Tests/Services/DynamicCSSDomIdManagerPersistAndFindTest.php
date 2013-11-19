<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 7:32 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicCSSDomIdTestInstanceFactory;

class DynamicCSSDomIdManagerPersistAndFindTest extends ContainerAwareUnitTestCase
{
    public function testPersistAndFind()
    {
        $dynamicCSSDomId = DynamicCSSDomIdTestInstanceFactory::createInstance();
        $dcdim = $this->get('ca.dcss.dom_id.manager');
        $dcdim->persist($dynamicCSSDomId);

        $d2 = $dcdim->findOneById($dynamicCSSDomId->getId());
        $this->assertTrue($dynamicCSSDomId->equals($d2));
    }
}