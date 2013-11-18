<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 7:54 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;

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

    /**
     * @return string
     */
    public function getUncacheableImageUri();

    /**
     * @param string $uncacheableImageUri
     * @return void
     */
    public function setUncacheableImageUri($uncacheableImageUri);
}