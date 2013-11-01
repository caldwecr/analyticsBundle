<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 9:22 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectorDomEvent;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Tests\Entity\DynamicJSSelectorDomEventClientDataSetTestInstanceFactory;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSSelectorDomEventDataSetsCympelManagerCPFRTest extends ContainerAwareUnitTestCase
{
    public function testCPFR()
    {
        $emName = 'cympelanalytics';
        $manager = $this->get('cympel_analytics.generics.manager');
        $creator = $manager->getCreator();
        $this->assertEquals('CympelCreator', $creator->getType());
        $finder = $manager->getFinder();
        $this->assertEquals('CympelFinder', $finder->getType());
        $persister = $manager->getPersister();
        $this->assertEquals('CympelPersister', $persister->getType());
        $remover = $manager->getRemover();
        $this->assertEquals('CympelRemover', $remover->getType());

        // Test creation
        $dataSets = $creator->create('DynamicJSSelectorDomEventClientDataSets');
        $this->assertEquals('DynamicJSSelectorDomEventClientDataSets', $dataSets->getType());

        // Create needed parent and descendant types
        /// Parent
        $selectorDomEvent = new DynamicJSSelectorDomEvent();
        $selectorDomEvent->setRepositoryName('CympelAnalyticsBundle:DynamicJSSelectorDomEvent');
        $selectorDomEvent->setEntityManagerName($emName);
        $selectorDomEvent->setClientDataSets($dataSets);

        ///Child
        $dataSet1 = DynamicJSSelectorDomEventClientDataSetTestInstanceFactory::generate();
        $dataSet2 = DynamicJSSelectorDomEventClientDataSetTestInstanceFactory::generate();


        $dataSets->setDataSets(new ArrayCollection(array($dataSet1, $dataSet2)));

        //Test persist
        $persister->persist($dataSets);
        $id = $dataSets->getId();
        //Test find
        $dataSets2 = $finder->findOneByIdAndClassAlias($id, "DynamicJSSelectorDomEventClientDataSets");
        $this->assertTrue($dataSets->equals($dataSets2));
        //Test remove
        $remover->remove($dataSets);
        $dataSets3 = $finder->findOneByIdAndClassAlias($id, "DynamicJSSelectorDomEventClientDataSets");
        $this->assertNull($dataSets3);
    }
}