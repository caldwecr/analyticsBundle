<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 11:26 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\ToolsBundle\Services\CympelService;

class TrackingToolValidator extends CympelService implements iTrackingToolValidator
{
    protected $validator;

    /**
     * @var string
     */
    protected static $classAlias = 'TrackingToolValidator';

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
}