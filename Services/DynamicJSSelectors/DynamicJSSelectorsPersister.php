<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:02 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJSSelectors;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsPersister;

class DynamicJSSelectorsPersister implements iDynamicJSSelectorsPersister
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var string - the name of the entity manager to use for ORM operations
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
     * @param DynamicJSSelectors $selectors
     * @return void
     */
    public function persist(DynamicJSSelectors $selectors)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($selectors);
        $em->flush();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorsPersister';
    }

}