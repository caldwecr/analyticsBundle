<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:13 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJSSelectors;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsRemover;

class DynamicJSSelectorsManager implements iDynamicJSSelectorsManager
{
    /**
     * @var iDynamicJSSelectorsCreator
     */
    protected $creator;

    /**
     * @var iDynamicJSSelectorsFinder
     */
    protected $finder;

    /**
     * @var iDynamicJSSelectorsPersister
     */
    protected $persister;

    /**
     * @var iDynamicJSSelectorsRemover
     */
    protected $remover;

    /**
     * @param iDynamicJSSelectorsCreator $creator
     * @param iDynamicJSSelectorsFinder $finder
     * @param iDynamicJSSelectorsPersister $persister
     * @param iDynamicJSSelectorsRemover $remover
     */
    public function __construct(iDynamicJSSelectorsCreator $creator, iDynamicJSSelectorsFinder $finder, iDynamicJSSelectorsPersister $persister, iDynamicJSSelectorsRemover $remover)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
    }

    /**
     * @return iDynamicJSSelectorsCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return iDynamicJSSelectorsFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    /**
     * @return iDynamicJSSelectorsPersister
     */
    public function getPersister()
    {
        return $this->persister;
    }

    /**
     * @return iDynamicJSSelectorsRemover
     */
    public function getRemover()
    {
        return $this->remover;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorsManager';
    }
}