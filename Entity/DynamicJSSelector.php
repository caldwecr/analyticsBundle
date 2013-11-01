<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 10:10 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectors;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DynamicJSSelector
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicJSSelector")
 */
class DynamicJSSelector extends CympelType implements iDynamicJSSelector
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
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=255)
     */
    protected $selection;

    /**
     * @var DynamicJSSelectors
     * @ORM\ManyToOne(targetEntity="DynamicJSSelectors", inversedBy="selectors", cascade={"persist"})
     * @ORM\JoinColumn(name="selectorsId", referencedColumnName="id")
     */
    protected $parentSelectors;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     *
     * The unix timestamp when the selector was created
     */
    protected $created;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     *
     * The unix timestamp when the selector was called (this means that a client triggered the event that is associated with the selector)
     */
    protected $called;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @return string
     *
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelector';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * @param string $selection
     * @return void
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;
    }

    /**
     * @return DynamicJSSelectors
     */
    public function getParentSelectors()
    {
        return $this->parentSelectors;
    }

    /**
     * @param iDynamicJSSelectors $selectors
     * @return void
     */
    public function setParentSelectors(iDynamicJSSelectors $selectors)
    {
        $this->parentSelectors = $selectors;
    }

    /**
     * @param int $called
     */
    public function setCalled($called)
    {
        $this->called = $called;
    }

    /**
     * @return int
     */
    public function getCalled()
    {
        return $this->called;
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
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return true;
    }

}