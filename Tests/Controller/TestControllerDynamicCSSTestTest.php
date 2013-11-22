<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/22/13
 * Time: 3:30 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerDynamicCSSTestTest extends WebTestCase
{
    public function testDynamicCSSTest()
    {
        $client = static::createClient();
        $uri = '/analytics/dynamic/test';
        $crawler = $client->request('GET', $uri);
        $success = $client->getResponse()->isSuccessful();

        if(!$success) {
            var_dump($client->getResponse()->getContent(), $uri);
        }
        $this->assertTrue($success);
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Number")')->count()
        );
    }
}
