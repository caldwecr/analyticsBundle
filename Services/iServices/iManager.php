<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:53 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

/**
 * Interface iManager
 * @package Cympel\Bundle\AnalyticsBundle\Services\iServices
 */
interface iManager extends iCreate, iFind, iPersist, iRemove, iExtend, iValidate
{
    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iValidator $validator
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null);


    /**
     * @param iExtender $extension
     * @return void
     */
    public function processExtension(iExtender $extension);
}