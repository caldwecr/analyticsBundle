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
        $uri = '/analytics/donor/path/run/route/traffic/report/'. $anHourAgo . '/' . $now;
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
