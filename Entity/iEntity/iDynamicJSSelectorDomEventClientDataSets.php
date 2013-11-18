<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 1:45 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;

interface iDynamicJSSelectorDomEventClientDataSets extends iFindable, iPersistable, iRemovable, iCreatable, iValidatable
{
    /**
     * @param ArrayCollection $dataSets
     * @return void
     */
    public function setDataSets(ArrayCollection $dataSets);

    /**
     * @return ArrayCollection
     */
    public function getDataSets();
}