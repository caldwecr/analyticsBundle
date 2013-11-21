<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/21/13
 * Time: 3:02 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DonorPathReportingControllerRunHoverReportTest extends WebTestCase
{
    public function testRunHoverReport()
    {
        $client = static::createClient();
        $now = time();
        $anHourAgo = $now - 3600;
        $uri = '/analytics/donor/path/run/hover/report/'. $anHourAgo . '/' . $now;
        $crawler = $client->request('GET', $uri);
        $success = $client->getResponse()->isSuccessful();

        if(!$success) {
            var_dump($client->getResponse()->getContent(), $uri);
        }
        $this->assertTrue($success);
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("BETWEEN")')->count()
        );
    }
}
