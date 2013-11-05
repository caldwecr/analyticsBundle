<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 4:09 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;


use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;

class CympelNamespaceTest extends \PHPUnit_Framework_TestCase {
    public function testSetName()
    {
        $cn = new CympelNamespace();
        $name = 'someName.foo';
        $cn->setName($name);
        $this->assertEquals($name, $cn->getName());
        $this->assertEquals(crc32($name), $cn->getNameCRC32());
    }
}
 