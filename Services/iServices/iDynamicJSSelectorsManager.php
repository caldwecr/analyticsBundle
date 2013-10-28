<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:27 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iDynamicJSSelectorsManager extends iType
{
    /**
     * @return iDynamicJSSelectorsCreator
     */
    public function getCreator();

    /**
     * @return iDynamicJSSelectorsFinder
     */
    public function getFinder();

    /**
     * @return iDynamicJSSelectorsPersister
     */
    public function getPersister();

    /**
     * @return iDynamicJSSelectorsRemover
     */
    public function getRemover();
}