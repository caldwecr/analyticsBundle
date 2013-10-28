<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 11:39 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;

class DynamicJSSelectorPersister implements iDynamicJSSelectorPersister
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var string - the name of the doctrine entity manager that the persister should use
     */
    protected $emName;

    public function __construct($doctrine, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->emName = $entityManagerName;
    }

    /**
     * @param DynamicJSSelector $dynamicJSSelector
     * @return void
     */
    public function persist(DynamicJSSelector $dynamicJSSelector)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($dynamicJSSelector);
        $em->flush();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorPersister';
    }

    /**
     * @param mixed $doctrine
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return mixed
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @param mixed $emName
     */
    public function setEmName($emName)
    {
        $this->emName = $emName;
    }

    /**
     * @return mixed
     */
    public function getEmName()
    {
        return $this->emName;
    }

}
