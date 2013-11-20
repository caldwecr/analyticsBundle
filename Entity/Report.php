<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 9:58 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReport;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Report
 * @package Cympel\Bundle\AnalyticsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="Report")
 */
class Report extends CympelType implements iReport
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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $query;

    /**
     * @var string
     */
    protected static $classAlias = 'Report';

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        self::areEqual($this, $rightSide);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        // TODO: Implement getQuery() method.
    }

    /**
     * @param string $query
     * @return void
     */
    public function setQuery($query)
    {
        // TODO: Implement setQuery() method.
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        // TODO: Implement setId() method.
    }

    /**
     * @return string
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        // TODO: Implement setName() method.
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return false;
    }

}