<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 9:19 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceEntities;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceEntity;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CympelNamespaceEntities
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="CympelNamespaceEntities")
 */
class CympelNamespaceEntities extends CympelType implements iNamespaceEntities
{
    /**
     * @var string
     */
    protected static $classAlias;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CympelNamespaceEntity", mappedBy="parentEntities", cascade={"persist", "remove"})
     */
    protected $entitiesArrayCollection;

    /**
     * @var iNamespace
     * @ORM\OneToOne(targetEntity="CympelNamespace", inversedBy="entities")
     * @ORM\JoinColumn(name="cympelnamespace_id", referencedColumnName="id")
     */
    protected $cympelNamespace;

    /**
     * @var array
     */
    protected $prototypeIndex;

    /**
     * @var bool
     */
    protected $indexIsStale;

    public function __construct()
    {
        $this->entitiesArrayCollection = new ArrayCollection();
        $this->indexIsStale = true;
    }

    public function refreshIndex()
    {
        $this->prototypeIndex = array();
        foreach($this->entitiesArrayCollection as $key => $value) {
            $pca = $value->getPrototypeClassAlias();
            $pci = $value->getPrototypeClassId();
            if(array_key_exists($pca, $this->prototypeIndex) && is_array($this->prototypeIndex[$pca])) {
                // The pca sub array already exists

            } else {
                // The pca sub array doesn't exist and needs to be created
                $this->prototypeIndex[$pca] = array();
                // Place the namespace key into the index so it can be retrieved in constant time by classAlias + classId
            }
            $this->prototypeIndex[$pca][$pci] = $value->getCympelNamespaceKey();
        }
        $this->indexIsStale = false;
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
     * @return void
     *
     * Sets the index of the iNamespaceableEntities entity to stale
     */
    public function makeIndexStale()
    {
        $this->indexIsStale = true;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $entitiesArrayCollection
     */
    public function setEntitiesArrayCollection(ArrayCollection $entitiesArrayCollection)
    {
        $this->entitiesArrayCollection = $entitiesArrayCollection;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEntitiesArrayCollection()
    {
        return $this->entitiesArrayCollection;
    }

    /**
     * @return int
     */
    public function getEntitiesCount()
    {
        return $this->entitiesArrayCollection->count();
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
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

    /**
     * @param mixed
     * @return iNamespaceEntity
     */
    public function getEntityByCympelNamespaceKey($key)
    {
        return $this->entitiesArrayCollection->get($key);
    }
}