<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:32 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceEntity;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespaceEntities;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CympelNamespaceEntity
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="CympelNamespaceEntity")
 */
class CympelNamespaceEntity extends CympelType implements iNamespaceEntity
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
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $prototypeClassAlias;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     */
    protected $prototypeId;

    /**
     * @var iNamespaceEntities
     * @ORM\ManyToOne(targetEntity="CympelNamespaceEntities", inversedBy="entitiesArrayCollection")
     * @ORM\JoinColumn(name="entities_id", referencedColumnName="id")
     */
    protected $parentEntities;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelNamespaceEntity';

    /**
     * @return int
     */
    public function getPrototypeId()
    {
        return $this->prototypeId;
    }

    /**
     * @param int $prototypeId
     * @return void
     */
    public function setPrototypeId($prototypeId)
    {
        $this->prototypeId = $prototypeId;
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
     * @param string $repositoryName
     * @return void
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }

    /**
     * @param string $entityManagerName
     * @return void
     */
    public function setEntityManagerName($entityManagerName)
    {
        $this->entityManagerName = $entityManagerName;
    }

    /**
     * @return string
     *
     * This method must return the fully qualified repository name
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @return string
     */
    public function getPrototypeClassAlias()
    {
        return $this->prototypeClassAlias;
    }

    /**
     * @param string $prototypeClassAlias
     * @return void
     */
    public function setPrototypeClassAlias($prototypeClassAlias)
    {
        $this->prototypeClassAlias = $prototypeClassAlias;
    }


    /**
     * @return string
     */
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
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
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceEntities $parentEntities
     */
    public function setParentEntities($parentEntities)
    {
        $this->parentEntities = $parentEntities;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceEntities
     */
    public function getParentEntities()
    {
        return $this->parentEntities;
    }

}