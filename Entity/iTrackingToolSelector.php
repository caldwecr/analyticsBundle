<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 10:17 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

/**
 * Interface iTrackingToolSelector
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 */
interface iTrackingToolSelector extends iSelector
{
    /**
     * @return DynamicJSSelectors
     */
    public function getParentSelectors();

    /**
     * @param DynamicJSSelectors $selectors
     * @return void
     */
    public function setParentSelectors(DynamicJSSelectors $selectors);
}