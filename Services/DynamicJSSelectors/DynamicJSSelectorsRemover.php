<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:07 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJSSelectors;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsRemover;

class DynamicJSSelectorsRemover extends CympelService implements iDynamicJSSelectorsRemover
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var string - the entity manager to use for ORM
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
    public function remove(DynamicJSSelectors $selectors)
    {
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($selectors);
        $em->flush();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorsRemover';
    }

}