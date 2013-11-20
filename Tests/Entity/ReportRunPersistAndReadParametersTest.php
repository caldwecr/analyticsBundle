<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 11:12 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class ReportRunPersistAndReadParametersTest extends ContainerAwareUnitTestCase
{
    public function testReportRunPersistAndReadParameters()
    {
        // Create the report
        $report = $this->get('ca.generics.creator')->create('Report');
        $report->setName(microtime(true));
        $report->setQuery('abcedfg');

        // Create the report run
        $r = $this->get('ca.generics.creator')->create('ReportRun');
        $r2 = $this->get('ca.generics.creator')->create('ReportRun');
        // Create the parameters array
        $p = array(
            'foo' => 'bar',
            'baz' => 123,
            'bof' => array(
                'feg'
            )
        );
        $r->setParameters($p);
        $r2->setParameters($p);
        // Status is a required property, set it to new
        $r->setStatus('new');
        $r2->setStatus('new');
        // Report is a required property, set it to the report created at the beginning
        $r->setReport($report);
        $r2->setReport($report);
        // Validate that the report run has a null id
        $this->assertNull($r->getId());
        $this->assertNull($r2->getId());

        // Validate that $r and $r2 are equal
        $this->assertTrue($r->equals($r2));

        // Persist the report run
        $this->get('ca.generics.persister')->persist($r);

        // Validate that $r and $2 are not equal
        $this->assertFalse($r->equals($r2));

        // Store the report run Id
        $reportRunId = $r->getId();

        // Validate that the report run id is not null
        $this->assertNotNull($reportRunId);

        // Now find the report run
        $r3 = $this->get('ca.generics.finder')->findOneByIdAndClassAlias($reportRunId, 'ReportRun');
        $this->assertTrue($r->equals($r3));
        $this->assertTrue($r3->equals($r));
        $this->assertFalse($r2->equals($r3));
        $this->assertFalse($r3->equals($r2));

        // Validate that the parameters match after persistence and retrieval from the database
        $p3 = $r3->getParameters();
        $this->assertEquals($p['foo'], $p3['foo']);
        $this->assertEquals($p['baz'], $p3['baz']);
        $this->assertEquals($p['bof'][0], $p3['bof'][0]);
    }
}