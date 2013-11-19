<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:03 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\ToolsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreatableRegistrar;
use Doctrine\Common\Collections\ArrayCollection;

class CreatableRegistrar extends CympelService implements iCreatableRegistrar
{
    /**
     * @var ArrayCollection
     */
    protected $classMap;

    /**
     * @var ArrayCollection
     */
    protected $repositoryNameMap;

    /**
     * @var ArrayCollection
     */
    protected $entityManagerNameMap;

    public function __construct()
    {
        $this->classMap = new ArrayCollection();
    }

    /**
     * @param string $class
     * @param string $alias
     * @param string $repositoryName
     * @param string $entityManagerName
     * @return void
     *
     * This method registers an association between an alias and a class
     */
    public function register($class, $alias, $repositoryName, $entityManagerName)
    {
        $this->classMap[$alias] = $class;
        $this->repositoryNameMap[$alias] = $repositoryName;
        $this->entityManagerNameMap[$alias] = $entityManagerName;

        // Setup the class alias property
        $class::setClassAlias($alias);
    }

    /**
     * @param string $alias
     * @return string
     *
     * This method returns the class associated with the alias
     */
    public function getClass($alias)
    {
        return $this->classMap[$alias];
    }

    /**
     * @param string $alias
     * @return string
     */
    public function getRepositoryNameForAlias($alias)
    {
        return $this->repositoryNameMap[$alias];
    }

    /**
     * @param string $alias
     * @return string
     */
    public function getEntityManagerNameForAlias($alias)
    {
        return $this->entityManagerNameMap[$alias];
    }

    /**
     * @var string
     */
    protected static $classAlias = 'CreatableRegistrar';

}