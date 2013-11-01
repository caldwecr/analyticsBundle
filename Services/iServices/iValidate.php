<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 10:24 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

interface iValidate extends iService
{
    /**
     * @return iValidator
     */
    public function getValidator();
}