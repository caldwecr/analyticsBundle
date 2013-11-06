<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 7:54 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\ConcreteCympelType;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToRemoveEntityException;

class CympelNamespacerRemoveInvalidTest extends ContainerAwareUnitTestCase
{
    public function testRemoveInvalid()
    {
        $namespacer = $this->get('ca.generics.namespacer');
        $ns = $this->get('cympel_analytics.generics.creator')->create('CympelNamespace');
        $ns->setName('testRemoveInvalid');
        $entity = new ConcreteCympelType();
        $e = null;
        try {
            $ns->removeEntityFromCympelNamespace($entity, $ns);
        } catch (InvalidAttemptToRemoveEntityException $e) {

        }
        $this->assertNotNull($e);

    }
}
/* class CympelNamespaceRemoveInvalidTest extends \PHPUnit_Framework_TestCase {
    public function testInvalidRemove()
    {
        $cn = new CympelNamespace();
        $e = null;
        try {
            $es = $cn->getEntities();
            $cn->remove(new ConcreteCympelType());
        }
    }
}*/
 