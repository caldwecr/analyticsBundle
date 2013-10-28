<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 3:28 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\TypeMismatchException;

class ConcreteCympelTypeEqualsTest extends \PHPUnit_Framework_TestCase
{
    public function testEquals()
    {
        $c1 = new ConcreteCympelType();
        $c1->setP1('foo');
        $c1->setP2('bar');

        $this->assertTrue($c1->equals($c1));

        $c2 = new ConcreteCympelType();

        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));

        $c2->setP1($c1->getP1());

        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));

        $c2->setP2($c1->getP2());

        $this->assertTrue($c1->equals($c2));
        $this->assertTrue($c2->equals($c1));

        $a = 0;
        try {
            $c3 = new DifferentConcreteCympelType();
            $c3->equals($c1);
        } catch (TypeMismatchException $e) {
            $a = 1;
        }
        $this->assertEquals(1, $a);
    }
}