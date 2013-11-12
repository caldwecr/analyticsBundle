<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 7:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iDynamicCSSImage extends iCreatable, iPersistable, iFindable, iRemovable, iValidatable
{
    /**
     * @param string $uri
     * @return void
     */
    public function setImageUri($uri);

    /**
     * @return string
     */
    public function getImageUri();
}