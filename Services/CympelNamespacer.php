<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 7:02 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\CympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToRemoveCympelNamespaceException;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespaceEntitiesManagerExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToSetEntityCympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\CannotCreateCympelNamespaceEntityFromEntityWithoutIdException;

class CympelNamespacer extends CympelService implements iNamespacer
{
    /**
     * @var iFinder
     */
    protected $finder;

    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var iNamespaceEntitiesManagerExtender
     */
    protected $namespaceableEntitiesManagerExtender;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelNamespacer';

    /*public function __construct(iCreator $creator, iFinder $finder, iNamespaceEntitiesManager $namespaceableEntitesManager)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->namespaceableEntitiesManager = $namespaceableEntitesManager;
    }*/
    public function __construct(iCreator $creator, iFinder $finder, iNamespaceEntitiesManagerExtender $entitiesManagerExtender)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->namespaceableEntitiesManagerExtender = $entitiesManagerExtender;
    }

    /**
     * @param iNamespaceable $entity
     * @param iNamespace $cympelNamespace
     * @return int
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToSetEntityCympelNamespace
     */
    public function addEntityToCympelNamespace(iNamespaceable $entity, iNamespace $cympelNamespace)
    {
        $ens = $entity->getCympelNamespace();
        if(!$ens || $cympelNamespace->equals($ens) || $ens->equals(CympelNamespace::getBlankCympelNamespace())) {
            $entity->setCympelNamespace($cympelNamespace);
            $cne = $this->createCympelNamespaceEntityFromNamespaceableEntity($entity);

            // append entity needs to take care of setting the parentEntities
            $entities = $cympelNamespace->getEntities();
            if(!$entities) {
                $entities = $this->creator->create('CympelNamespaceEntities');
                $cympelNamespace->setEntities($entities);
            }
            $this->namespaceableEntitiesManagerExtender->appendEntity($cympelNamespace->getEntities(), $cne);
        } else {
            if(!$ens) {
                throw new InvalidAttemptToSetEntityCympelNamespace("Namespace was null");
            } else {
                throw new InvalidAttemptToSetEntityCympelNamespace('This entity already has a namespace associated with it, to change the namespace first remove the existing one.');
            }
        }
        return $cympelNamespace->getEntityCount();

    }

    /**
     * @param iNamespaceable $entity
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iCreatableAndFindable
     * @throws CannotCreateCympelNamespaceEntityFromEntityWithoutIdException
     */
    protected function createCympelNamespaceEntityFromNamespaceableEntity(iNamespaceable $entity)
    {
        $cne = $this->creator->create('CympelNamespaceEntity');
        $cne->setPrototypeClassAlias($entity->getType());
        $eId = $entity->getId();
        if(!$eId) {
            throw new CannotCreateCympelNamespaceEntityFromEntityWithoutIdException();
        }
        $cne->setPrototypeId($eId);
        return $cne;
    }

    /**
     * @param iNamespaceable $entity
     * @param iNamespace $cympelNamespace
     * @return int
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToRemoveCympelNamespaceException
     */
    public function removeEntityFromCympelNamespace(iNamespaceable $entity, iNamespace $cympelNamespace)
    {
        $e_cns = $entity->getCympelNamespace();
        if($e_cns && $e_cns->equals($cympelNamespace)) {
            $entity->setCympelNamespace(CympelNamespace::getBlankCympelNamespace());
            $cne = $this->createCympelNamespaceEntityFromNamespaceableEntity($entity);
            $this->namespaceableEntitiesManagerExtender->removeEntity($cympelNamespace->getEntities(), $cne);
        } else {
            throw new InvalidAttemptToRemoveCympelNamespaceException();
        }
        return $cympelNamespace->getEntityCount();
    }

    /**
     * @param $key
     * @param iNamespace $cympelNamespace
     * @return iFindable
     */
    public function getEntityByNamespaceKey($key, iNamespace $cympelNamespace)
    {
        $cympelNamespaceEntity = $this->namespaceableEntitiesManagerExtender->getNamespaceEntityByCympelNamespaceKey($key, $cympelNamespace);
        $created = $this->finder->findOneByIdAndClassAlias($cympelNamespaceEntity->getPrototypeId(), $cympelNamespaceEntity->getPrototypeClassAlias());
        return $created;
    }

    public function findOrCreateNamespaceByName($namespaceName)
    {
        $n = $this->finder->findOneByPropertyAndClassAlias(array('name' => $namespaceName), CympelNamespace::getClassAlias());
        if(!$n){
            $n = $this->creator->create(CympelNamespace::getClassAlias());
            $n->setName($namespaceName);
            $n->setCreated(time());
            $n->setDescription('Description: ' . $namespaceName);
        }
        return $n;
    }
}