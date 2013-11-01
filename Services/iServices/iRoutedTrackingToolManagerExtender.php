<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 3:57 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

interface iRoutedTrackingToolManagerExtender extends iTrackingToolManagerExtensionService
{
    /**
     * @return iRouter
     */
    public function getRouter();
}