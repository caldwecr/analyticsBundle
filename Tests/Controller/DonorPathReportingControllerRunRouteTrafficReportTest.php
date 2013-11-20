<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 3:52 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DonorPathReportingControllerRunRouteTrafficReportTest extends WebTestCase
{
    public function testRunRouteTrafficReportAction()
    {
        $client = static::createClient();
        $now = time();
        $anHourAgo = $now - 3600;
        $crawler = $client->request('GET', '/analytics/donor/path/run/route/traffic/report/'. $anHourAgo . '/' . $now);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("BETWEEN")')->count()
        );
    }
}
