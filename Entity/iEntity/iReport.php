<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 9:57 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;

interface iReport extends iPersistable, iFindable, iRemovable, iValidatable, iCreatable
{
    /**
     * @return string
     */
    public function getQuery();

    /**
     * @param string $query
     * @return void
     */
    public function setQuery($query);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);
}