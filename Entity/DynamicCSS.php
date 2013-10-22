<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:31 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DynamicCSS
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicCSS")
 */
class DynamicCSS implements iType
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
     * @ORM\Column(type="string", length=50)
     *
     * The name of the pseudo class the dynamic css should target
     */
    protected $pseudo;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicCSSDomId", mappedBy="dynamicCSS", cascade={"persist", "remove"})
     *
     * An ArrayCollection of DynamicCSSDomId objects that the dynamic css should target, this is combined with the $pseudo value to create the css selectors
     */
    protected $dynamicCSSDomIds;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     *
     * The unix timestamp when the DynamicCSS instance was created
     */
    protected $created;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     *
     * The unix timestamp when the DynamicCSS instance was rendered and then sent to the client
     */
    protected $rendered;

    /**
     * A default constructor
     */
    public function __construct()
    {
        $this->created = time();
        $this->rendered = 0;
        $this->pseudo = 'hover';
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $dynamicCSSDomIds
     */
    public function setDynamicCSSDomIds($dynamicCSSDomIds)
    {
        $this->dynamicCSSDomIds = $dynamicCSSDomIds;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDynamicCSSDomIds()
    {
        return $this->dynamicCSSDomIds;
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
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
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
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSS';
    }

}
