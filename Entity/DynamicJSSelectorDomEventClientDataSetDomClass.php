<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:04 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSetDomClass;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSetDomClasses;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DynamicJSSelectorDomEventClientDataSetDomClass
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelectorDomEventClientDataSetDomClass")
 */
class DynamicJSSelectorDomEventClientDataSetDomClass extends CympelType implements iDynamicJSSelectorDomEventClientDataSetDomClass
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
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var DynamicJSSelectorDomEventClientDataSetDomClasses
     * @ORM\ManyToOne(targetEntity="DynamicJSSelectorDomEventClientDataSetDomClasses", inversedBy="classes", cascade={"persist"})
     * @ORM\JoinColumn(name="classes_id", referencedColumnName="id")
     */
    protected $parentClasses;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $className;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicJSSelectorDomEventClientDataSetDomClass';

    public function __construct()
    {
        $this->className = '';
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
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
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
     * @param iDynamicJSSelectorDomEventClientDataSetDomClasses $parentClasses
     */
    public function setParentClasses(iDynamicJSSelectorDomEventClientDataSetDomClasses $parentClasses)
    {
        $this->parentClasses = $parentClasses;
    }

    /**
     * @return DynamicJSSelectorDomEventClientDataSetDomClasses
     */
    public function getParentClasses()
    {
        return $this->parentClasses;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

}