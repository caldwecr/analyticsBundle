<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 3:30 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicCSSDomIdTestInstanceFactory;

class DynamicCSSDomIdDomIdValueTooShortTest extends ContainerAwareUnitTestCase
{
    public function testTooShortDomIdValue()
    {
        $domId = DynamicCSSDomIdTestInstanceFactory::createInstance();
        $dcdim = $this->get('ca.dcss.dom_id.manager');
        $domId->setDomIdValue('a');
        $errors = $dcdim->validate($domId);
        $this->assertEquals(1, count($errors));
    }
}