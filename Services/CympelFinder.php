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
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;

class CympelFinder extends CympelService implements iFinder
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var iCreatableRegistrar
     */
    protected $registrar;

    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelFinder';

    /**
     * @param $doctrine
     * @param iCreatableRegistrar $registrar
     * @param iCreator $creator
     */
    public function __construct($doctrine, iCreatableRegistrar $registrar, iCreator $creator)
    {
        $this->doctrine = $doctrine;
        $this->registrar = $registrar;
        $this->creator = $creator;
    }

    /**
     * @param string $id
     * @param string $classAlias
     * @return iFindable
     */
    public function findOneByIdAndClassAlias($id, $classAlias)
    {
        $findable = $this->creator->create($classAlias);
        $repositoryName = $findable->getRepositoryName();
        $entityManagerName = $findable->getEntityManagerName();
        $repository = $this->doctrine->getRepository($repositoryName, $entityManagerName);
        $found = $repository->findOneById($id);
        if($found) {
            $found->setRepositoryName($repositoryName);
            $found->setEntityManagerName($entityManagerName);
        }
        return $found;
    }
}