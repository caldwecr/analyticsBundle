<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;

interface iDynamicJSDomEvents extends iType, iPersistable, iFindable, iCreatable, iRemovable, iValidatable
{
    /**
     * @param ArrayCollection $events
     * @return void
     */
    public function setEvents(ArrayCollection $events);
}