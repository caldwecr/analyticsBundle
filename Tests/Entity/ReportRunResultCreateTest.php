<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 12:02 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\ReportRunResult;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ReportRunResultCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreateReportRunResult()
    {
        $r = $this->get('ca.generics.creator')->create('ReportRunResult');
        $this->assertEquals(ReportRunResult::getClassAlias(), $r->getClassAlias());
    }
}