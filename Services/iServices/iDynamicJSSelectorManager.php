<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:33 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iDynamicJSSelectorManager extends iType
{
    /**
     * @return iDynamicJSSelectorCreator
     */
    public function getCreator();

    /**
     * @return iDynamicJSSelectorFinder
     */
    public function getFinder();

    /**
     * @return iDynamicJSSelectorPersister
     */
    public function getPersister();

    /**
     * @return iDynamicJSSelectorRemover
     */
    public function getRemover();
}