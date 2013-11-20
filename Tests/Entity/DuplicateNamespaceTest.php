<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/7/13
 * Time: 11:53 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;

/**
 * Class DuplicateNamespaceTest
 * @package Cympel\Bundle\AnalyticsBundle\Tests\Services
 *
 * This test attempts to create two namespaces with the same name (and persist them), which is not allowed
 */
class DuplicateNamespaceTest extends ContainerAwareUnitTestCase
{
    /**
     * @var iCreator
     */
    protected $creator;

    public function testDuplicate()
    {


        // Setup required services

        $this->creator = $this->get('ca.generics.creator');
        /**
         * @var iPersister
         */
        $persister = $this->get('ca.generics.persister');
        $remover = $this->get('cympel_analytics.generics.remover');

        // Create the first namespace
        $firstNS = $this->creator->create('CympelNamespace');
        $firstNS->setName('notAduplicate');
        $firstNS->setDescription('The first NS in the DuplicateNS test');
        $firstNS->setCreated(time());
        // Persist the first namespace

        // Create the second namespace

        // Try to persist the second namespace and catch exception - DuplicateCympelNamespaceException

        // Clean up
            // Remove the first namespace

    }
}