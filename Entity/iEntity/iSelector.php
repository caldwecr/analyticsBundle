<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 10:14 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

/**
 * Interface iSelector
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 */
interface iSelector extends iType
{
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
    public function getSelection();

    /**
     * @param string $selection
     * @return void
     */
    public function setSelection($selection);
}