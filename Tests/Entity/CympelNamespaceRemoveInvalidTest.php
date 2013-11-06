<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 7:54 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;


use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToRemoveEntityException;

class CympelNamespaceRemoveInvalidTest extends \PHPUnit_Framework_TestCase {
    public function testInvalidRemove()
    {
        $cn = new CympelNamespace();
        $e = null;
        try {
            $cn->remove(new ConcreteCympelType());
        } catch (InvalidAttemptToRemoveEntityException $e) {

        }
        $this->assertNotNull($e);
    }
}
 