<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:40 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\ConcretePersistableTestType;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class CympelFinderFindTest extends ContainerAwareUnitTestCase
{
    public function testFind()
    {
        $finder = $this->get('cympel_analytics.generics.finder');

        $cp = new ConcretePersistableTestType();
        $cp->setValue('alotoffooz');
        $cp->setEntityManagerName('cympelanalytics');
        $cp->setRepositoryName('CympelAnalyticsBundle:ConcretePersistableTestType');

        $em = $this->get('doctrine')->getManager($cp->getEntityManagerName());
        $em->persist($cp);

        $id = $cp->getId();

        $cp2 = $finder->findOneByIdAndClassAlias($id, 'ConcretePersistableTestType');

        $this->assertTrue($cp->equals($cp2));
    }
}