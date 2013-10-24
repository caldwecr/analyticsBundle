<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 2:45 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class DynamicCSSDomIdArrayCollection extends ArrayCollection
{
    private $tempIds;

    public function setTempIds($tempIds)
    {
        $this->tempIds = $tempIds;
    }

    public function getTempIds()
    {
        return $this->tempIds;
    }
}
