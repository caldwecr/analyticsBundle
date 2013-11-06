<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 7:43 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;


use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;

class CympelNamespaceEntityCountTest extends \PHPUnit_Framework_TestCase {
    public function testEntityCount()
    {
        $cn = new CympelNamespace();
        $this->assertEquals(0, $cn->getEntityCount());
        $t = new ConcreteCympelType();
        $t->setCympelNamespaceKey('foo');
        $es = $cn->getEntities();
        $es_ac = $es->getEntitiesArrayCollection();
        $es_ac->set($t->getCympelNamespaceKey(), $t);
        $es->setEntitiesArrayCollection($es_ac);
        $this->assertEquals(1, $cn->getEntityCount());
        $es_ac->remove($t->getCympelNamespaceKey());
        $es->setEntitiesArrayCollection($es_ac);
        $this->assertEquals(0, $cn->getEntityCount());
    }
}
 