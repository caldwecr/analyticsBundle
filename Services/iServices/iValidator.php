<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 10:21 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iValidatable;

interface iValidator extends iService
{
    public function validate(iValidatable $validatable);
}