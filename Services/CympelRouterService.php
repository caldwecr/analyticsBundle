<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 2:20 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\Exception\ServiceTypesNotComparableException;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRouter;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iService;
use Symfony\Component\Routing\Router;

abstract class CympelRouterService extends Router implements iService, iRouter
{
    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelRouterService';
    }

    /**
     * @param iType $rightSide
     * @return bool|void
     * @throws ServiceTypesNotComparableException
     */
    public function equals(iType $rightSide)
    {
        throw new ServiceTypesNotComparableException('Descendants of the CympelService abstract class do not inherently have the ability to assess equality');
    }

}