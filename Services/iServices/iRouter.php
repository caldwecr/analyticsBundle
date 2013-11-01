<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 2:11 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Symfony\Component\Routing\Router;

interface iRouter extends iType
{
    /**
     * @param string $name
     * @param mixed $parameters
     * @param bool|string $referenceType
     * @return string
     */
    public function generate($name, $parameters = array(), $referenceType = Router::ABSOLUTE_PATH);
}