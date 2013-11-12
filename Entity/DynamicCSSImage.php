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
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
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
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string", length=10)
     *
     * @Assert\Length(min="3", max="10")
     * @Assert\NotNull()
     *
     * Must be unique
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $imageUri;

    /**
     * @var int
     *
     * @ORM\Column(type="bigint")
     * @Assert\NotNull()
     */
    protected $uriCRC32;

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
}