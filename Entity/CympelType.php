<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 3:03 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iAliasable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespace;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\TypeMismatchException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CympelType
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 */
abstract class CympelType extends AliasableType implements iType, iNamespaceable, iFindable, iAliasable
{
    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var int
     */
    protected $id;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

    /**
     * @return string
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
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
     * @var iNamespace
     * @ORM\ManyToOne(targetEntity="CympelNamespace", cascade={"persist"})
     * @ORM\JoinTable(name="cympelNamespace_cympeltype",
     *      joinColumns={@ORM\JoinColumn(name="cympeltype_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="cympelnamespace_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $cympelNamespace;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $cympelNamespaceKey = '';

    /**
     * @param iNamespace $cympelNamespace
     * @return void
     */
    public final function setCympelNamespace(iNamespace $cympelNamespace)
    {
        $this->cympelNamespace = $cympelNamespace;
    }

    /**
     * @return iNamespace
     */
    public final function getCympelNamespace()
    {
        return $this->cympelNamespace;
    }

    /**
     * @param string $key
     * @return void
     */
    public final function setCympelNamespaceKey($key)
    {
        $this->cympelNamespaceKey = $key;
    }

    /**
     * @return string
     */
    public final function getCympelNamespaceKey()
    {
        return $this->cympelNamespaceKey;
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
        self::confirmSameType($this, $rightSide);
        return $this->typedEquals($rightSide);
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    abstract protected function typedEquals(iType $rightSide);

    /**
     * @param iType $leftSide
     * @param iType $rightSide
     * @return bool
     */
    protected final static function areEqual(iType $leftSide, iType $rightSide)
    {
        self::confirmSameType($leftSide, $rightSide);
        foreach($leftSide as $key => $value) {
            if($value !== $rightSide->$key) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param iType $leftSide
     * @param iType $rightSide
     * @throws Exception\TypeMismatchException
     */
    protected final static function confirmSameType(iType $leftSide, iType $rightSide)
    {
        $leftSideType = $leftSide->getType();
        $rightSideType = $rightSide->getType();
        if($leftSideType !== $rightSideType) {
            throw new TypeMismatchException("types do not match: leftside = {$leftSideType}, rightside = {$rightSideType}");
        }
    }
}