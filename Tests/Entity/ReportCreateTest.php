<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 10:17 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\Report;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ReportCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreateReport()
    {
        $r = $this->get('ca.generics.creator')->create('Report');
        $this->assertEquals(Report::getClassAlias(), $r->getClassAlias());
    }
}