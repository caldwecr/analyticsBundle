<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/5/13
 * Time: 8:32 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iNamespaceableEntity;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;

class CympelNamespaceableEntity extends CympelType implements iNamespaceableEntity
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
     * @var string
     */
    protected $prototypeClassAlias;

    /**
     * @var int
     */
    protected $prototypeId;

    /**
     * @return mixed
     */
    public function getPrototypeId()
    {
        return $this->prototypeId;
    }

    /**
     * @param mixed $prototypeId
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
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelNamespaceableEntity';
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

}