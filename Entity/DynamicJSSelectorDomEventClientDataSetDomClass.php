<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 2:04 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSetDomClass;
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
     * @ORM\ManyToOne(targetEntity="DynamicJSSelectorDomEventClientDataSetDomClasses", inversedBy="classes")
     * @ORM\JoinColumn(name="classes_id", referencedColumnName="id")
     */
    protected $parentClasses;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    protected $className;

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
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorDomEventClientDataSetDomClass';
    }

}