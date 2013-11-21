<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 3:35 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSManagerCreatePersistRemoveTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $t = new Tracker();

        $dcm = $this->get('ca.dcss.manager');
        $dcss = $dcm->createTrackingTool('DynamicCSS', $t);

        // Original comment: Verify that the id is initially blank and is then set by the persist operation
        // The Id should no longer be null as it will be set as part of the call to createTrackingTool, this is
        // due to the fact that createTrackingTool is responsible for binding a namespace to the entity
        // and that can only be done once an entity has an id
        $this->assertNotNull($dcss->getId());
        $dcm->getPersister()->persist($dcss);
        $id = $dcss->getId();
        $this->assertNotNull($id);

        // Look up the same DynamicCSS object by the id and verify the two are the same
        $dcss2 = $dcm->getFinder()->findOneByIdAndClassAlias($id, 'DynamicCSS');
        $this->assertTrue($dcss2->equals($dcss));

        // Remove the object and verify that it can't be recovered by findOneById
        $dcm->getRemover()->remove($dcss);
        $dcss3 = $dcm->getFinder()->findOneByIdAndClassAlias($id, 'DynamicCSS');
        $this->assertNull($dcss3);

    }
}