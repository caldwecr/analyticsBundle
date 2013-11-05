<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:31 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iCreatable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iValidatable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DynamicCSS
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="DynamicCSS")
 */
class DynamicCSS extends RoutedTrackingTool implements iCreatable, iPersistable, iRemovable, iFindable, iValidatable
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
     * @var DynamicCSSDomIdArrayCollection
     * @ORM\OneToMany(targetEntity="DynamicCSSDomId", mappedBy="dynamicCSS", cascade={"persist", "remove"})
     *
     * An DynamicCSSDomIdArrayCollection that the dynamic css should target, this is combined with the $pseudo value to create the css selectors
     */
    protected $dynamicCSSDomIds;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     * @Assert\GreaterThanOrEqual(value = 0)
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
     * @var iTracker
     * @ORM\ManyToOne(targetEntity="Tracker", inversedBy="trackingTools", cascade={"persist"})
     * @ORM\JoinColumn(name="tracker_id", referencedColumnName="id")
     */
    protected $tracker;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var string
     */
    protected $repositoryName;

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
     * @param DynamicCSSDomIdArrayCollection $dynamicCSSDomIds
     */
    public function setDynamicCSSDomIds(DynamicCSSDomIdArrayCollection $dynamicCSSDomIds)
    {
        $this->dynamicCSSDomIds = $dynamicCSSDomIds;
    }

    /**
     * @return DynamicCSSDomIdArrayCollection
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

    /**
     * @param iTracker $tracker
     * @return bool
     */
    public function setTracker(iTracker $tracker)
    {
        $this->tracker = $tracker;
    }

    /**
     * @return iTracker
     */
    public function getTracker()
    {
        return $this->tracker;
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
     * @return bool
     *
     * This method must return true if the tool has validation constraints that should be checked, otherwise false
     */
    public function hasValidationConstraints()
    {
        return true;
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

}
