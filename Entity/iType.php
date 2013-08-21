<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 7/25/13
 * Time: 10:16 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

interface iType
{
    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType();
}