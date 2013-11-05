<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Doctrine\Common\Collections\ArrayCollection;

interface iDynamicJSDomEvents extends iType, iPersistable, iFindable, iCreatable, iRemovable, iValidatable
{
    /**
     * @param ArrayCollection $events
     * @return void
     */
    public function setEvents(ArrayCollection $events);
}