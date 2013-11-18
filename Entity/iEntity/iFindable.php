<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 9:22 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;

interface iFindable extends iType
{
    /**
     * @return string
     *
     * This method must return the fully qualified repository name
     */
    public function getRepositoryName();

    /**
     * @return string
     */
    public function getEntityManagerName();
}