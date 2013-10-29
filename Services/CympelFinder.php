<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:29 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreatableRegistrar;

class CympelFinder extends CympelService implements iFinder
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var CreatableRegistrar
     */
    protected $registrar;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @param Object $doctrine
     * @param iCreatableRegistrar $registrar
     * @param string $entityManagerName
     */
    public function __construct($doctrine, iCreatableRegistrar $registrar, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->registrar = $registrar;
        $this->entityManagerName = $entityManagerName;
    }

    /**
     * @param string $id
     * @param string $classAlias
     * @return iFindable
     */
    public function findOneByIdAndClassAlias($id, $classAlias)
    {
        $findableType = $this->registrar->getClass($classAlias);
        $findable = new $findableType;
        $repository = $this->doctrine->getRepository($findable->getRepositoryName(), $findable->getEntityManagerName());
        $found = $repository->findOneById($id);
        return $found;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelFinder';
    }

}