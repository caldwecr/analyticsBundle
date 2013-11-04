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