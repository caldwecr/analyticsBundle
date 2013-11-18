<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 7:57 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicCSSImage;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DynamicCSSImage
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicCSSImage")
 */
class DynamicCSSImage extends CympelType implements iDynamicCSSImage
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(min="3", max="255")
     * @Assert\NotNull()
     *
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $imageUri;

    protected $uncacheableImageUri;

    /**
     * @var int
     *
     * @ORM\Column(type="bigint")
     * @Assert\NotNull()
     */
    protected $uriCRC32;

    /**
     * @var DynamicCSSDomId
     * @ORM\OneToOne(targetEntity="DynamicCSSDomId", mappedBy="image", cascade={"persist"})

     */
    protected $dynamicCSSDomId;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSImage';

    /**
     * @param mixed $uncacheableImageUri
     */
    public function setUncacheableImageUri($uncacheableImageUri)
    {
        $this->uncacheableImageUri = $uncacheableImageUri;
    }

    /**
     * @return mixed
     */
    public function getUncacheableImageUri()
    {
        return $this->uncacheableImageUri;
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        self::areEqual($this, $rightSide);
    }

    /**
     * @param string $uri
     * @return void
     */
    public function setImageUri($uri)
    {
        $this->imageUri = $uri;
        $this->uriCRC32 = crc32($uri);
    }

    /**
     * @return string
     */
    public function getImageUri()
    {
        return $this->imageUri;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return true;
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
     * @return int
     */
    public function getUriCRC32()
    {
        return $this->uriCRC32;
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
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS $dynamicCSSDomId
     */
    public function setDynamicCSSDomId($dynamicCSSDomId)
    {
        $this->dynamicCSSDomId = $dynamicCSSDomId;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS
     */
    public function getDynamicCSSDomId()
    {
        return $this->dynamicCSSDomId;
    }
}