<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 12:22 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorRemover;

class DynamicJSSelectorRemover extends CympelService implements iDynamicJSSelectorRemover
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var string - the name of the entity manager that should be used
     */
    protected $emName;

    /**
     * @param Object $doctrine
     * @param string $entityManagerName
     */
    public function __construct($doctrine, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->emName = $entityManagerName;
    }

    /**
     * @param DynamicJSSelector $selector
     * @return void
     */
    public function remove(DynamicJSSelector $selector)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($selector);
        $em->flush();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorRemover';
    }

    /**
     * @param Object $doctrine
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return Object
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @param string $emName
     */
    public function setEmName($emName)
    {
        $this->emName = $emName;
    }

    /**
     * @return string
     */
    public function getEmName()
    {
        return $this->emName;
    }

}