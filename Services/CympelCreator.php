<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:12 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\ToolsBundle\Services\CympelService;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;

class CympelCreator extends CympelService implements iCreator
{
    /**
     * @var CreatableRegistrar
     */
    protected $registrar;

    /**
     * @param CreatableRegistrar $registrar
     */
    public function __construct(CreatableRegistrar $registrar)
    {
        $this->registrar = $registrar;
    }

    /**
     * @param string $classAlias
     * @return iCreatable
     */
    public function create($classAlias)
    {
        $creatable = $this->registrar->getClass($classAlias);
        $created = new $creatable;
        $created->setEntityManagerName($this->registrar->getEntityManagerNameForAlias($classAlias));
        $created->setRepositoryName($this->registrar->getRepositoryNameForAlias($classAlias));
        $created->setCympelNamespaceKey('');
        return $created;
    }
    /**
     * @var string
     */
    protected static $classAlias = 'CympelCreator';

}