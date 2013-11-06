<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:41 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DynamicCSSDomId
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicCSSDomId")
 */
class DynamicCSSDomId extends CympelType
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
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "The domIdValue must be between 1 and 255 characters in length",
     *      maxMessage = "The domIdValue must be between 1 and 255 characters in length"
     * )
     */
    protected $domIdValue;

    /**
     * @var DynamicCSS
     * @ORM\ManyToOne(targetEntity="DynamicCSS", inversedBy="dynamicCSSDomIds", cascade={"persist"})
     * @ORM\JoinColumn(name="dynamicCSS_id", referencedColumnName="id")
     */
    protected $dynamicCSS;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     * @Assert\GreaterThanOrEqual(value=0)
     *
     * The unix timestamp when the DynamicCSSDomId object was created
     */
    protected $created;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     * @Assert\GreaterThanOrEqual(value=0)
     *
     * The unix timestamp when the DynamicCSSDomId object was rendered
     */
    protected $rendered;

    /**
     * @var string
     *
     * Note that this property is NOT persisted to the database and is included only for accessor support in twig templates
     */
    protected $url;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSDomId';

    /**
     * A basic constructor that initializes a few scalar properties
     */
    public function __construct()
    {
        $this->created = time();
        $this->rendered = 0;
        $this->domIdValue = '';
    }

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
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param int $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $rendered
     */
    public function setRendered($rendered)
    {
        $this->rendered = $rendered;
    }

    /**
     * @return int
     */
    public function getRendered()
    {
        return $this->rendered;
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