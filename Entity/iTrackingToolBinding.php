<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 4:08 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

interface iTrackingToolBinding extends iType
{
    /**
     * @return string
     */
    public function getBindingKey();

    /**
     * @param iTrackingToolBindingKey $key
     * @return mixed
     */
    public function setBindingKey(iTrackingToolBindingKey $key);

    /**
     * @return mixed
     */
    public function getBindingValue();

    /**
     * @param iTrackingToolBindingValue $value
     * @return mixed
     */
    public function setBindingValue(iTrackingToolBindingValue $value);
}