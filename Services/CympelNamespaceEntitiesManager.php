<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 10:21 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceEntity;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespaceEntitiesManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespaceEntitiesManagerExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;

class CympelNamespaceEntitiesManager extends CympelManager implements iNamespaceEntitiesManager
{
    /**
     * @var string
     */
    protected static $classAlias = 'CympelNamespaceEntitiesManager';

    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iValidator $validator
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->validator = $validator;
        $this->setNamespaceEntitiesManagerExtender($extender);
    }

    /**
     * @param iNamespaceEntitiesManagerExtender $extender
     */
    protected final function setNamespaceEntitiesManagerExtender(iNamespaceEntitiesManagerExtender $extender)
    {
        $this->extender = $extender;
    }

    /**
     * @param $key
     * @param iNamespace $cympelNamespace
     * @return iNamespaceEntity
     */
    public function getNamespaceEntityByCympelNamespaceKey($key, iNamespace $cympelNamespace)
    {
        $entities = $cympelNamespace->getEntities();
        $cympelNamespaceEntity = $entities->getEntityByCympelNamespaceKey($key);
        return $cympelNamespaceEntity;
    }


}