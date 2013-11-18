<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:28 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\InvalidFindablePropertyException;

interface iFinder extends iType
{
    /**
     * @param string $id
     * @param string $classAlias
     * @return iFindable
     */
    public function findOneByIdAndClassAlias($id, $classAlias);

    /**
     * @param array $property
     * @param $classAlias
     * @return iFindable
     * @throws InvalidFindablePropertyException
     */
    public function findOneByPropertyAndClassAlias($property = array(), $classAlias);
}