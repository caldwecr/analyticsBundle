<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:52 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\Exception;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;

class InvalidTrackingToolException extends \Exception implements iType
{
    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'InvalidTrackingToolException';
    }

}