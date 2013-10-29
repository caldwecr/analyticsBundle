<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:12 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iCreatable;
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
        return new $creatable;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelCreator';
    }

}