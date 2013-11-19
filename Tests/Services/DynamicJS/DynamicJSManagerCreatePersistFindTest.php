<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 10:03 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSManagerCreatePersistFindTest extends ContainerAwareUnitTestCase
{
    public function testCreatePersistFind()
    {
        $djm = $this->get('ca.djs.manager');
        $dj = $djm->getCreator()->create('DynamicJS');
        $djm->getPersister()->persist($dj);
        $dj2 = $djm->getFinder()->findOneByIdAndClassAlias($dj->getId(), 'DynamicJS');
        $this->assertTrue($dj->equals($dj2));
        $this->assertTrue($dj2->equals($dj));
    }
}