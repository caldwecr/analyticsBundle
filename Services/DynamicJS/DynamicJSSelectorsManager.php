<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:13 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;

class DynamicJSSelectorsManager extends CympelService implements iDynamicJSSelectorsManager
{
    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var iFinder
     */
    protected $finder;

    /**
     * @var iPersister
     */
    protected $persister;

    /**
     * @var iRemover
     */
    protected $remover;

    /**
     * @var iDynamicJSSelectorManager
     */
    protected $selectorManager;

    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iDynamicJSSelectorManager $selectorManager
     */
    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iDynamicJSSelectorManager $selectorManager)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->selectorManager = $selectorManager;
    }

    /**
     * @param $selectorArray
     * @return DynamicJSSelectors
     */
    public function createFromArray($selectorArray)
    {
        $selectors = $this->creator->create('DynamicJSSelectors');
        foreach($selectorArray as $key => $value) {
            $selectors[$key] = $this->selectorManager->getCreator()->create('DynamicJSSelector');
            $selectors[$key]->setSelection($value);
            $selectors[$key]->setParentSelectors($selectors);
            $selectors[$key]->setCreated(time());
            $selectors[$key]->setCalled(0);
        }
        return $selectors;
    }

    /**
     * @return iCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return iFinder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    /**
     * @return iPersister
     */
    public function getPersister()
    {
        return $this->persister;
    }

    /**
     * @return iRemover
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