<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 9:50 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;


use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespaceEntities;

class CympelNamespaceableEntitiesRefreshIndexTest extends \PHPUnit_Framework_TestCase {
    public function testRefreshIndex()
    {
        $entities = new CympelNamespaceEntities();
        $entity = new ConcreteCympelType();
        $entity->setCympelNamespaceKey('somecoolkey');
        $ns = new CympelNamespace('somecoolnamespace');
        $entity->setCympelNamespace($ns);

        $entities_ac = $entities->getEntitiesArrayCollection();
        $entities_ac->set($entity->getCympelNamespaceKey(), $entity);
        $entities->setEntitiesArrayCollection($entities_ac);
        //@todo add some assertions
    }

}
 