<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/21/13
 * Time: 3:28 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

interface iHaveNamespacer
{
    /**
     * @return iNamespacer
     */
    public function getNamespacer();
}