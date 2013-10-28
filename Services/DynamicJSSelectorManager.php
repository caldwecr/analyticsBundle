<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:55 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorRemover;

/**
 * Class DynamicJSSelectorManager
 * @package Cympel\Bundle\AnalyticsBundle\Services
 */
class DynamicJSSelectorManager implements iDynamicJSSelectorManager
{
    /**
     * @var iDynamicJSSelectorCreator
     */
    protected $creator;

    /**
     * @var iDynamicJSSelectorFinder
     */
    protected $finder;

    /**
     * @var iDynamicJSSelectorPersister
     */
    protected $persister;

    /**
     * @var iDynamicJSSelectorRemover
     */
    protected $remover;

    /**
     * @param iDynamicJSSelectorCreator $creator
     * @param iDynamicJSSelectorFinder $finder
     * @param iDynamicJSSelectorPersister $persister
     * @param iDynamicJSSelectorRemover $remover
     */
    public function __construct(iDynamicJSSelectorCreator $creator, iDynamicJSSelectorFinder $finder, iDynamicJSSelectorPersister $persister, iDynamicJSSelectorRemover $remover)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorManager';
    }

    /**
     * @return iDynamicJSSelectorCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return iDynamicJSSelectorFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    /**
     * @return iDynamicJSSelectorPersister
     */
    public function getPersister()
    {
        return $this->persister;
    }

    /**
     * @return iDynamicJSSelectorRemover
     */
    public function getRemover()
    {
        return $this->remover;
    }

}