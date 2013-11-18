<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 8/21/13
 * Time: 9:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class RouteTraffic
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="routeTraffic")
 */
class RouteTraffic extends CympelType
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * This is the name of route that was trafficked
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var int
     * The unix timestamp when the route was trafficked
     * @ORM\Column(type="bigint")
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected static $classAlias = 'RouteTraffic';

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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