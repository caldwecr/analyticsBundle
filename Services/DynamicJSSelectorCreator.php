<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 10:41 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorCreator;

class DynamicJSSelectorCreator implements iDynamicJSSelectorCreator
{

    public function create()
    {
        return new DynamicJSSelector();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorCreator';
    }

}