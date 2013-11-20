<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:46 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\ReportRun;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ReportRunCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreateReportRun()
    {
        $r = $this->get('ca.generics.creator')->create('ReportRun');
        $this->assertEquals(ReportRun::getClassAlias(), $r->getClassAlias());
    }
}