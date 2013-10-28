<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:55 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;

/**
 * Class DynamicJSSelectorManager
 * @package Cympel\Bundle\AnalyticsBundle\Services
 */
class DynamicJSSelectorManager implements iType
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
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iDynamicJSSelectorCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iDynamicJSSelectorFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iDynamicJSSelectorPersister
     */
    public function getPersister()
    {
        return $this->persister;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iDynamicJSSelectorRemover
     */
    public function getRemover()
    {
        return $this->remover;
    }

}