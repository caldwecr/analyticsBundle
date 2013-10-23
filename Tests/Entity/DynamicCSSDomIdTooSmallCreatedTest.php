<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 7:23 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicCSSDomIdTestInstanceFactory;

class DynamicCSSDomIdTooSmallCreatedTest extends ContainerAwareUnitTestCase
{
    public function testValidCreated()
    {
        $domId = DynamicCSSDomIdTestInstanceFactory::createInstance();
        $dcdim = $this->get('cympel_analytics.dynamic_css_dom_id_manager');
        $domId->setCreated(-1);
        $errors = $dcdim->validate($domId);

        $this->assertEquals(1, count($errors));
    }
}