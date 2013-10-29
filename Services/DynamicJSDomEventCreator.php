<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:42 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;

class DynamicJSDomEventCreator extends CympelService implements iCreator
{
    /**
     * @return iCreatable
     */
    public function create()
    {
        return new DynamicJSDomEvent();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEventCreator';
    }

}