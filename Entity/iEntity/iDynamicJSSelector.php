<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 8:15 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingToolSelector;

interface iDynamicJSSelector extends iTrackingToolSelector, iCreatable, iPersistable, iRemovable, iFindable
{

}