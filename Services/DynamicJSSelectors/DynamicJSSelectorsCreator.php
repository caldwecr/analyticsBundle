<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:38 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJSSelectors;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Services\CympelService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsCreator;

class DynamicJSSelectorsCreator extends CympelService implements iDynamicJSSelectorsCreator
{
    /**
     * @return DynamicJSSelectors
     */
    public function create()
    {
        return new DynamicJSSelectors();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorsCreator';
    }

}