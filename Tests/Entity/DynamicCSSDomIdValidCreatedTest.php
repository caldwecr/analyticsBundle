<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 7:22 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicCSSDomIdTestInstanceFactory;

class DynamicCSSDomIdValidCreatedTest extends ContainerAwareUnitTestCase
{
    public function testValidCreated()
    {
        $domId = DynamicCSSDomIdTestInstanceFactory::createInstance();
        $dcdim = $this->get('ca.dcss.dom_id.manager');
        $domId->setCreated(123456789);
        $errors = $dcdim->validate($domId);

        $this->assertEquals(0, count($errors));
    }
}