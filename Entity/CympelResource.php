<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 10:15 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iServableResource;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;

class CympelResource extends CympelType implements iServableResource
{
    /**
     * @var string
     */
    protected static $classAlias = 'CympelResource';

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        return self::areEqual($this, $rightSide);
    }

}