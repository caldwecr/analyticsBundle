<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\ToolsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;

class CympelManager extends CympelService implements iManager
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
     * @var iExtender
     */
    protected $extender;

    /**
     * @var iValidator
     */
    protected $validator;

    /**
     * @var iNamespacer
     */
    protected $namespacer;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelManager';

    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iNamespacer $namespacer
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iValidator $validator
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iNamespacer $namespacer, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->validator = $validator;
        $this->extender = $extender;
        $this->namespacer = $namespacer;
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
     * @return iExtender
     */
    public function getExtender()
    {
        return $this->extender;
    }

    /**
     * @return iValidator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return iNamespacer
     */
    public function getNamespacer()
    {
        return $this->namespacer;
    }

    /**
     * @param iExtender $extension
     */
    public function processExtension(iExtender $extension)
    {
        // Nothing happens
    }

}