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

class CympelNamespacer extends CympelService implements iNamespacer
{
    /**
     * @var iFinder
     */
    protected $finder;

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
            $cympelNamespace->append($entity);
        } else {
            throw new InvalidAttemptToSetEntityCympelNamespace();
        }
        return $cympelNamespace->getEntityCount();

    }

    /**
     * @param iNamespaceable $entity
     * @param iNamespace $cympelNamespace
     * @return int
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToRemoveCympelNamespaceException
     */
    public function removeEntityFromCympelNamespace(iNamespaceable $entity, iNamespace $cympelNamespace)
    {
        if($entity->getCympelNamespace()->equals($cympelNamespace)) {
            $entity->setCympelNamespace(CympelNamespace::getBlankCympelNamespace());
            $cympelNamespace->remove($entity);
        } else {
            throw new InvalidAttemptToRemoveCympelNamespaceException();
        }
        return $cympelNamespace->getEntityCount();
    }

    public function getEntityByNamespaceKey($key, iNamespace $cympelNamespace)
    {
        $cympelNamespaceEntity = $cympelNamespace->getNamespaceEntityByCympelNamespaceKey($key);
        $created = $this->finder->findOneByIdAndClassAlias($cympelNamespaceEntity->get)
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