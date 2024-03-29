<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:41 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicCSSImage;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iValidatable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DynamicCSSDomId
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicCSSDomId")
 */
class DynamicCSSDomId extends CympelType implements iPersistable, iRemovable, iFindable, iNamespaceable, iValidatable, iCreatable
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
     * @var iDynamicCSSImage
     * @ORM\OneToOne(targetEntity="DynamicCSSImage", inversedBy="dynamicCSSDomId", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="dynamicCSSImage_id", referencedColumnName="id")
     */
    protected $image;

    protected static $defaultImageUri = 'bundles/cympelanalytics/assets/images/pixel.jpg';

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSDomId';

    public function getImageUri()
    {
        if($this->image) {
            return $this->image->getImageUri();
        } else {
            return static::$defaultImageUri;
        }
    }

    public function getUncacheableImageUri()
    {
        if($this->image) {
            return $this->image->getUncacheableImageUri();
        } else {
            return static::$defaultImageUri;
        }
    }

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

    /**
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicCSSImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicCSSImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return true;
    }


}