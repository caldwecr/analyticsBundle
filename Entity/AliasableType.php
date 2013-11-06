<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 2:25 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iAliasable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\ChildClassOfCympelTypeFailsToOverrideClassAliasException;

abstract class AliasableType implements iType, iAliasable
{
    /**
     * @var string
     */
    protected static $classAlias;

    /**
     * @return string
     */
    public static final function getClassAlias()
    {
        $childClassAlias = static::$classAlias;
        if(!self::isClassAliasValid($childClassAlias)) {
            // Nothing to do here .. an exception will have been thrown
        }
        // Return the child class's classAlias property using late static binding
        return $childClassAlias;
    }

    /**
     * @param $classAlias
     * @return void
     */
    public static final function setClassAlias($classAlias)
    {
        if(!self::isClassAliasValid($classAlias)) {
            // Nothing to do here -- exception will have been thrown
        }
        static::$classAlias = $classAlias;
    }

    /**
     * @param $classAlias
     * @return bool
     * @throws Exception\ChildClassOfCympelTypeFailsToOverrideClassAliasException
     */
    protected final static function isClassAliasValid($classAlias)
    {
        if(self::$classAlias === $classAlias) {
            throw new ChildClassOfCympelTypeFailsToOverrideClassAliasException();
        }
        return true;
    }

    public final function getType()
    {
        return $this->getClassAlias();
    }
}