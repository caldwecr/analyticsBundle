<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 7:33 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;

class CympelNamespaceEqualsTest extends \PHPUnit_Framework_TestCase {
    public function testEquals()
    {
        $cn1 = new CympelNamespace();
        $cn2 = new CympelNamespace();
        $cn1->setName('foo');
        $this->assertFalse($cn1->equals($cn2));
        $cn1->setName('bar');
        $cn2->setName('bar');
        $this->assertTrue($cn1->equals($cn2));
    }
}
 