<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:12 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\CympelType;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\ServiceTypesNotComparableException;

abstract class CympelService extends CympelType
{
    public function equals(iType $rightSide)
    {
        throw new ServiceTypesNotComparableException('Descendants of the CympelService abstract class do not inherently have the ability to assess equality');
    }
}