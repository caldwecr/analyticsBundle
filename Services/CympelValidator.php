<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 10:30 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iValidatable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;

class CympelValidator extends CympelService implements iValidator
{
    /**
     * @var Object - the validator service
     */
    protected $validator;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelValidator';

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param iValidatable $validatable
     * @return array of errors
     */
    public function validate(iValidatable $validatable)
    {
        $errors = array();
        if($validatable->hasValidationConstraints()) {
            $errors = $this->validator->validate($validatable);
        }
        return $errors;
    }

    /**
     * @param iValidatable $validatable
     * @return bool
     */
    public function isValid(iValidatable $validatable)
    {
        $errors = $this->validate($validatable);
        if(count($errors) === 0) {
            return true;
        }
        return false;
    }

}