<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 11:45 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

class DynamicJSSelectorFinder implements iType
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var string - the name of the entity manager to use
     */
    protected $emName;

    /**
     * @param Object $doctrine
     * @param string $emName
     */
    public function __construct($doctrine, $emName)
    {
        $this->doctrine = $doctrine;
        $this->emName = $emName;
    }

    /**
     * @param $id
     * @return DynamicJSSelector
     */
    public function findOneById($id)
    {
        $repository = $this->doctrine->getRepository('CympelAnalyticsBundle:DynamicJSSelector', $this->emName);
        $selector = $repository->findOneById($id);
        return $selector;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorFinder';
    }

}