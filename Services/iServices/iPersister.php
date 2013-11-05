<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:49 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\InvalidPersistableException;

interface iPersister extends iType
{
    /**
     * @param iPersistable $persistable
     * @throws InvalidPersistableException
     * @return void
     */
    public function persist(iPersistable $persistable);
}