<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 3:03 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\TypeMismatchException;

abstract class CympelType implements iType
{
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
        $leftSideType = $this->getType();
        $rightSideType = $rightSide->getType();
        if($leftSideType !== $rightSideType) {
            throw new TypeMismatchException("types do not match: leftside = {$leftSideType}, rightside = {$rightSideType}");
        }
        return $this->typedEquals($rightSide);
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    abstract protected function typedEquals(iType $rightSide);
}