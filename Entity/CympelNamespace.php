<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 3:59 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\DuplicateCympelNamespaceException;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\TypeMismatchException;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceEntities;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CympelNamespace
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="CympelNamespace")
 */
class CympelNamespace extends CympelType implements iNamespace
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
     * @Assert\NotNull()
     * @Assert\Length(min="0", max="255")
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(type="bigint")
     * @Assert\NotNull()
     */
    protected $nameCRC32;

    /**
     * @var int
     *
     * @ORM\Column(type="bigint")
     * @Assert\NotNull()
     */
    protected $created;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotNull()
     */
    protected $description;

    /**
     * @var array
     *
     * @ORM\OneToOne(targetEntity="CympelNamespaceEntities", mappedBy="cympelNamespace")
     */
    protected $entities;

    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @param string $cympelNamespaceName
     */
    public function __construct($cympelNamespaceName = '_blank')
    {
        $this->entities = new CympelNamespaceEntities();
        $this->setName($cympelNamespaceName);
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws DuplicateCympelNamespaceException
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->setNameCRC32();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $created
     * @return void
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelNamespace';
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
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return true;
    }

    /**
     * @param int $nameCRC32
     */
    public final function setNameCRC32($nameCRC32 = 0)
    {
        $this->nameCRC32 = crc32($this->name);
    }

    /**
     * @return int
     */
    public final function getNameCRC32()
    {
        return $this->nameCRC32;
    }

    /**
     * @param iType $rightSide
     * @throws TypeMismatchException
     * @return bool
     *
     * This method should first compare an objects type to the arguments type, if they do not match to method should return throw a TypeMismatchException
     * containing the string "types do not match: leftside = ..., rightside = ..."
     * Otherwise return true if they are equals otherwise false
     */
    public function equals(iType $rightSide)
    {
        return self::cympelNamespaceEquals($this, $rightSide);
    }

    /**
     * @param iNamespace $leftSide
     * @param iNamespace $rightSide
     * @return bool
     */
    private static function cympelNamespaceEquals(iNamespace $leftSide, iNamespace $rightSide)
    {
        $a = $leftSide->getName() === $rightSide->getName();
        return $a;
    }

    /**
     * @return iNamespace
     */
    public static function getBlankCympelNamespace()
    {
        $t = new CympelNamespace();
        $t->setName('_blank');
        return $t;
    }

    /**
     * @return int
     */
    public function getEntityCount()
    {
        if($this->entities) {
            return $this->entities->getEntitiesCount();
        }
        return 0;
    }

    /**
     * @return iNamespaceEntities
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param iNamespaceEntities $entities
     * @return void
     */
    public function setEntities(iNamespaceEntities $entities)
    {
        $this->entities = $entities;
    }
}