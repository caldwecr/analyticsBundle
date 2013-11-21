<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 10:44 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\ConcretePersistableTestType;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelValidatorValidateTest extends ContainerAwareUnitTestCase
{
    public function testValidate()
    {
        $validator = $this->get('ca.generics.validator');
        $validatable = new ConcretePersistableTestType();
        // Length of value needs to be between 2 and 10 so this should pass
        $validatable->setValue('foo');
        $this->assertEquals(0, count($validator->validate($validatable)));
        $this->assertTrue($validator->isValid($validatable));
        // Now try too short of a value
        $validatable->setValue('a');
        $this->assertEquals(1, count($validator->validate($validatable)));
        $this->assertFalse($validator->isValid($validatable));
        // Now try a value that is too long
        $validatable->setValue('blahblahblahblah');
        $this->assertEquals(1, count($validator->validate($validatable)));
        $this->assertFalse($validator->isValid($validatable));
    }
}