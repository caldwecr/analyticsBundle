<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;

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
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iExtender $extender)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->extender = $extender;
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
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelManager';
    }

}