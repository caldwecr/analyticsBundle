<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 3:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\DuplicateCympelNamespaceException;

interface iNamespace extends iType
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @throws DuplicateCympelNamespaceException
     * @return void
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description);

    /**
     * @return int
     */
    public function getCreated();

    /**
     * @param int $created
     * @return void
     */
    public function setCreated($created);
}