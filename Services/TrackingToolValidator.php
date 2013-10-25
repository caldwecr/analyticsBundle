<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 11:26 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

class TrackingToolValidator implements iTrackingToolValidator
{
    protected $validator;

    /**
     * @param $validator
     */
    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param iTrackingTool $tool
     * @return bool
     */
    public function validate(iTrackingTool $tool)
    {
        if(!$tool->hasValidationConstraints()) {
            return true;
        }
        $errors = $this->validator->validate($tool);
        if(count($errors) > 0) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'TrackingToolValidator';
    }

}