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

    /**
     * @param iType $rightSide
     * @throws TypeMismatchException
     * @return bool
     *
     * This method should first compare an objects type to the arguments type, if they do not match to method should return throw a TypeMismatchException
     * containing the string "types do not match: leftside = ..., rightside = ..."
     * Otherwise return true if they are equals otherwise false
     */
    public function equals(iType $rightSide)
    {
        if($this->getType() === $rightSide->getType()) {
            return true;
        }
        return false;
    }

}