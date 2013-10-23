<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

interface iTracker extends iType
{
    /**
     * @param iTracker $rightSide
     * @return bool
     *
     * This method evaluates the equality of the object against the argument
     */
    public function equals(iTracker $rightSide);
}