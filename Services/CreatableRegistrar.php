<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:03 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreatableRegistrar;
use Doctrine\Common\Collections\ArrayCollection;

class CreatableRegistrar extends CympelService implements iCreatableRegistrar
{
    /**
     * @var ArrayCollection
     */
    protected $map;

    public function __construct()
    {
        $this->map = new ArrayCollection();
    }

    /**
     * @param $class
     * @param $alias
     * @return void
     *
     * This method registers an association between an alias and a class
     */
    public function register($class, $alias)
    {
        $this->map[$alias] = $class;
    }

    /**
     * @param string $alias
     * @return string
     *
     * This method returns the class associated with the alias
     */
    public function getClass($alias)
    {
        return $this->map[$alias];
    }


    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CreatableRegistrar';
    }

}