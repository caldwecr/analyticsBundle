<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iCreatableRegistrar extends iType
{
    /**
     * @param string $class
     * @param string $alias
     * @return void
     *
     * This method registers an association between an alias and a class
     */
    public function register($class, $alias);

    /**
     * @param string $alias
     * @return string
     *
     * This method returns the class associated with the alias
     */
    public function getClass($alias);
}
