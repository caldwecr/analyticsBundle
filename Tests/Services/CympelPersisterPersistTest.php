<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:57 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\ConcretePersistableTestType;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelPersisterPersistTest extends ContainerAwareUnitTestCase
{
    public function testPersist()
    {
        $persister = $this->get('cympel_anayltics.generics.persister');
        $cp = new ConcretePersistableTestType();
        $cp->setEntityManagerName('cympelanalytics');
        $cp->setValue("foobarz");
        $persister->persist($cp);
        $id = $cp->getId();

        $repository = $this->get('doctrine')->getRepository('CympelAnalyticsBundle:ConcretePersistableTestType', $cp->getEntityManagerName());
        $cp2 = $repository->findOneById($id);

        $this->assertTrue($cp->equals($cp2));
    }
}


