<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 8:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicCSSDomIdTestInstanceFactory;

class DynamicCSSDomIdManagerFindOneByDynamicCSSAndDomIdValueTest extends ContainerAwareUnitTestCase
{
    public function testFindOneByDCSSAndDomIdValue()
    {
        $dcdim = $this->get('ca.dcss.dom_id.manager');
        $dcssdi = DynamicCSSDomIdTestInstanceFactory::createInstance();
        $dcdim->persist($dcssdi);
        $dcssdi2 = $dcdim->findOneByDynamicCSSAndDomIdValue($dcssdi->getDynamicCSS(), $dcssdi->getDomIdValue());
        $this->assertTrue($dcssdi->equals($dcssdi2));
    }
}