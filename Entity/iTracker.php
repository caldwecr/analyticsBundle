<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

interface iTracker extends iType
{
    /**
     * @param iTracker $rightSide
     * @return bool
     *
     * This method evaluates the equality of the object against the argument
     */
    public function equals(iTracker $rightSide);

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