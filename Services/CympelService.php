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
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\ServiceTypesNotComparableException;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\ServiceTypesDoNotHaveEntityIdsException;

abstract class CympelService extends CympelType
{
    /**
     * @param iType $rightSide
     * @return bool|void
     * @throws Exception\ServiceTypesNotComparableException
     */
    public function equals(iType $rightSide)
    {
        throw new ServiceTypesNotComparableException('Descendants of the CympelService abstract class do not inherently have the ability to assess equality');
    }

    /**
     * @param iType $rightSide
     * @return bool|void
     * @throws Exception\ServiceTypesNotComparableException
     */
    protected function typedEquals(iType $rightSide)
    {
        throw new ServiceTypesNotComparableException('Descendants of the CympelService abstract class do not inherently have the ability to assess equality');
    }

    /**
     * @return int|void
     * @throws Exception\ServiceTypesDoNotHaveEntityIdsException
     */
    public function getId()
    {
        throw new ServiceTypesDoNotHaveEntityIdsException('Descendants of the CympelService abstract class do not inherently have entity manager id properties');
    }
}