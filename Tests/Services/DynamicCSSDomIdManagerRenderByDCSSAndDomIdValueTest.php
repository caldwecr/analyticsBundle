<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 8:07 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicCSSDomIdTestInstanceFactory;

class DynamicCSSDomIdManagerRenderByDCSSAndDomIdValueTest extends ContainerAwareUnitTestCase
{
    public function testRenderByDCSSAndDomIdValue()
    {
        $dcdim = $this->get('ca.dcss.dom_id.manager');
        $dcssdi = DynamicCSSDomIdTestInstanceFactory::createInstance('DynamicCSSDomIdManagerRenderByDCSSAndDomIdValueTest', $this->get('ca.generics.creator'));
        $dcdim->persist($dcssdi);
        $dcssdi2 = $dcdim->findOneByDynamicCSSAndDomIdValue($dcssdi->getDynamicCSS(), $dcssdi->getDomIdValue());
        $this->assertTrue($dcssdi->equals($dcssdi2));
        $this->assertEquals(0, $dcssdi2->getRendered());

        // This section validates that the rendered property has been set and persisted
        $dcssdi3 = $dcdim->renderByDynamicCSSAndDomIdValue($dcssdi->getDynamicCSS(), $dcssdi->getDomIdValue());
        $this->assertNotEquals(0, $dcssdi3->getRendered());
        $this->assertTrue($dcssdi->equals($dcssdi3));
        $this->assertNotEquals(0, $dcssdi2->getRendered());
    }
}