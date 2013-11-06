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
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToSetEntityCympelNamespace;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\CannotCreateCympelNamespaceEntityFromEntityWithoutIdException;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespaceEntitiesManager;

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
     * @var iNamespaceEntitiesManager
     */
    protected $namespaceableEntitiesManager;

    public function __construct(iCreator $creator, iFinder $finder, iNamespaceEntitiesManager $namespaceableEntitesManager)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->namespaceableEntitiesManager = $namespaceableEntitesManager;
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
        if(!$ens || $ens->equals(CympelNamespace::getBlankCympelNamespace())) {
            $entity->setCympelNamespace($cympelNamespace);
            $cne = $this->createCympelNamespaceEntityFromNamespaceableEntity($entity);

            // append entity needs to take care of setting the parentEntities
            $this->namespaceableEntitiesManager->getExtender()->appendEntity($cympelNamespace->getEntities(), $cne);
        } else {
            throw new InvalidAttemptToSetEntityCympelNamespace();
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
            $this->namespaceableEntitiesManager->getExtender()->removeEntity($cympelNamespace->getEntities(), $cne);
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
        $cympelNamespaceEntity = $cympelNamespace->getNamespaceEntityByCympelNamespaceKey($key);
        $created = $this->finder->findOneByIdAndClassAlias($cympelNamespaceEntity->getPrototypeId(), $cympelNamespaceEntity->getPrototypeClassAlias());
        return $created;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelNamespacer';
    }

}