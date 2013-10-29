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
     * @return iCreator
     */
    public function getCreator();

    /**
     * @return iFinder
     */
    public function getFinder();

    /**
     * @return iPersister
     */
    public function getPersister();

    /**
     * @return iRemover
     */
    public function getRemover();
}