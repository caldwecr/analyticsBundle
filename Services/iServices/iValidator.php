<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 10:21 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;

/**
 * Interface iValidator
 * @package Cympel\Bundle\AnalyticsBundle\Services\iServices
 */
interface iValidator extends iService
{
    /**
     * @param iValidatable $validatable
     * @return array of errors
     */
    public function validate(iValidatable $validatable);

    /**
     * @param iValidatable $validatable
     * @return bool
     */
    public function isValid(iValidatable $validatable);
}