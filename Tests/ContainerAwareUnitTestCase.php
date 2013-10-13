<?php

namespace Cympel\Bundle\AnalyticsBundle\Tests;

// This assumes that this class file is located at:
// src/Application/AcmeBundle/Tests/ContainerAwareUnitTestCase.php
// with Symfony 2.0 Standard Edition layout. You may need to change it
// to fit your own file system mapping.
if(file_exists(__DIR__ . '/../../../../../app/AppKernel.php')) {
    require_once __DIR__ . '/../../../../../app/AppKernel.php';
} else if(file_exists(__DIR__ . '/../../../../app/AppKernel.php')) {
    require_once __DIR__ . '/../../../../app/AppKernel.php';
} else if(file_exists(__DIR__ . '/../../../../../../app/AppKernel.php')){
    require_once __DIR__ . '/../../../../../../app/AppKernel.php';
} else if(file_exists(__DIR__ . '/../../../../../../../app/AppKernel.php')) {
    require_once __DIR__ . '/../../../../../../../app/AppKernel.php';
} else {
    throw new \Exception("Cannot find the app's AppKernel.php file in ContainerAwareUnitTestCase.");
}

class ContainerAwareUnitTestCase extends \PHPUnit_Framework_TestCase
{
    protected static $kernel;
    protected static $container;

    public static function setUpBeforeClass()
    {
        self::$kernel = new \AppKernel('dev', true);
        self::$kernel->boot();

        self::$container = self::$kernel->getContainer();
    }

    public function get($serviceId)
    {
        return self::$kernel->getContainer()->get($serviceId);
    }
}