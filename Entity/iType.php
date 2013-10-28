<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 7/25/13
 * Time: 10:16 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\TypeMismatchException;

interface iType
{
    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType();


    /**
     * @param iType $rightSide
     * @throws TypeMismatchException
     * @return bool
     *
     * This method should first compare an objects type to the arguments type, if they do not match to method should return throw a TypeMismatchException
     * containing the string "types do not match: leftside = ..., rightside = ..."
     * Otherwise return true if they are equals otherwise false
     */
    public function equals(iType $rightSide);
}