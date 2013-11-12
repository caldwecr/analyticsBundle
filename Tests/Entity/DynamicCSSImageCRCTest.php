<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 8:10 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;


use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSImage;

class DynamicCSSImageCRCTest extends \PHPUnit_Framework_TestCase {
    public function testCRC()
    {
        $d = new DynamicCSSImage();
        $uri = 'www.google.com';
        $d->setImageUri($uri);
        $this->assertEquals(crc32($uri), $d->getUriCRC32());
    }
}
 