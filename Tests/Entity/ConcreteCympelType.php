<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 3:27 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\CympelType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;

class ConcreteCympelType extends CympelType
{
    protected $p1;

    protected $p2;

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

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'ConcreteCympelType';
    }

    /**
     * @param mixed $p1
     */
    public function setP1($p1)
    {
        $this->p1 = $p1;
    }

    /**
     * @return mixed
     */
    public function getP1()
    {
        return $this->p1;
    }

    /**
     * @param mixed $p2
     */
    public function setP2($p2)
    {
        $this->p2 = $p2;
    }

    /**
     * @return mixed
     */
    public function getP2()
    {
        return $this->p2;
    }


}