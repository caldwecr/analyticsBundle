<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:41 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DynamicCSSDomId
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicCSSDomId")
 */
class DynamicCSSDomId implements iType
{
    /**
     * @var int
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $domIdValue;

    /**
     * @var DynamicCSS
     * @ORM\ManyToOne(targetEntity="DynamicCSS", inversedBy="dynamicCSSDomIds")
     * @ORM\JoinColumn(name="dynamicCSS_id", referencedColumnName="id")
     */
    protected $dynamicCSS;

    /**
     * @param string $domIdValue
     */
    public function setDomIdValue($domIdValue)
    {
        $this->domIdValue = $domIdValue;
    }

    /**
     * @return string
     */
    public function getDomIdValue()
    {
        return $this->domIdValue;
    }

    /**
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS $dynamicCSS
     */
    public function setDynamicCSS($dynamicCSS)
    {
        $this->dynamicCSS = $dynamicCSS;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS
     */
    public function getDynamicCSS()
    {
        return $this->dynamicCSS;
    }

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
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSDomId';
    }

}