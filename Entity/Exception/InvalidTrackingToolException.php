<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:52 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\Exception;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;

abstract class InvalidTrackingToolException extends \Exception implements iType
{

}