<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 10:17 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

/**
 * Interface iTrackingToolSelector
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 */
interface iTrackingToolSelector extends iSelector
{
    /**
     * @return iDynamicJSSelectors
     */
    public function getParentSelectors();

    /**
     * @param iDynamicJSSelectors $selectors
     * @return void
     */
    public function setParentSelectors(iDynamicJSSelectors $selectors);
}