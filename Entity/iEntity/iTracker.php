<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iTracker extends iType
{
    /**
     * @return ArrayCollection
     */
    public function getTrackingTools();

    /**
     * @param ArrayCollection $tools
     * @return void
     */
    public function setTrackingTools(ArrayCollection $tools);
}