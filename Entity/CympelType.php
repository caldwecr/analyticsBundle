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
        self::confirmSameType($this, $rightSide);
        return $this->typedEquals($rightSide);
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    abstract protected function typedEquals(iType $rightSide);

    /**
     * @param iType $leftSide
     * @param iType $rightSide
     * @return bool
     */
    protected final static function areEqual(iType $leftSide, iType $rightSide)
    {
        self::confirmSameType($leftSide, $rightSide);
        foreach($leftSide as $key => $value) {
            if($value !== $rightSide->$key) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param iType $leftSide
     * @param iType $rightSide
     * @throws Exception\TypeMismatchException
     */
    protected final static function confirmSameType(iType $leftSide, iType $rightSide)
    {
        $leftSideType = $leftSide->getType();
        $rightSideType = $rightSide->getType();
        if($leftSideType !== $rightSideType) {
            throw new TypeMismatchException("types do not match: leftside = {$leftSideType}, rightside = {$rightSideType}");
        }
    }
}