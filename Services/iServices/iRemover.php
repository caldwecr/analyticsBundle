<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 8:36 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iRemovable;

interface iRemover extends iType
{
    /**
     * @param iRemovable $removable
     * @return void
     */
    public function remove(iRemovable $removable);
}