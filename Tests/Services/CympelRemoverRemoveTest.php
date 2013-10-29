<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 8:44 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\ConcretePersistableTestType;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelRemoverRemoveTest extends ContainerAwareUnitTestCase
{
    public function testRemove()
    {
        $cp = new ConcretePersistableTestType();
        $cp->setEntityManagerName('cympelanalytics');
        $cp->setValue('someotherbaz');

        $em = $this->get('doctrine')->getManager($cp->getEntityManagerName());
        $em->persist($cp);
        $em->flush();

        $id = $cp->getId();

        $repository = $this->get('doctrine')->getRepository('CympelAnalyticsBundle:ConcretePersistableTestType', $cp->getEntityManagerName());
        $cp2 = $repository->findOneById($id);

        $this->assertTrue($cp->equals($cp2));

        $remover = $this->get('cympel_analytics.generics.remover');
        $remover->remove($cp);

        $cp3 = $repository->findOneById($id);

        $this->assertNull($cp3);
    }
}