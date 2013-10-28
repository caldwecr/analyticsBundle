<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:55 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSDomEvents extends CympelType
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var DynamicJS
     */
    protected $dynamicJ;

    /**
     * @var ArrayCollection of DynamicJSDomEvent objects
     */
    protected $events;


    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEvents';
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        return self::areEqual($this, $rightSide);
    }


}