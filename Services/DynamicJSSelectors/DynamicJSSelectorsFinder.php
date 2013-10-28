<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:56 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJSSelectors;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsFinder;

class DynamicJSSelectorsFinder implements iDynamicJSSelectorsFinder
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var string - the name of the entity manager to use for doctrine operations
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
     * @param int $id
     * @return DynamicJSSelectors
     */
    public function findOneById($id)
    {
        $repository = $this->doctrine->getRepository('CympelAnalyticsBundle:DynamicJSSelectors');
        $d = $repository->findOneById($id);
        return $d;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorsFinder';
    }

}