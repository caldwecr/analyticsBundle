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
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReportRun;
use Cympel\Bundle\ToolsBundle\Entity\CympelType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $query;

    /**
     * @var string
     */
    protected static $classAlias = 'Report';

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ReportRun", mappedBy="report", cascade={"persist", "remove"})
     */
    protected $reportRuns;

    public function __construct()
    {
        $this->reportRuns = new ArrayCollection();
    }

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
        return $this->query;
    }

    /**
     * @param string $query
     * @return void
     */
    public function setQuery($query)
    {
        $this->query = $query;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function hasValidationConstraints()
    {
        return true;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $reportRuns
     */
    public function setReportRuns($reportRuns)
    {
        $this->reportRuns = $reportRuns;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReportRuns()
    {
        return $this->reportRuns;
    }

    /**
     * @param iReportRun $reportRun
     * @return void
     */
    public function addRun(iReportRun $reportRun)
    {
        $this->reportRuns->add($reportRun);
    }

    /**
     * @param iReportRun $reportRun
     * @return void
     */
    public function removeRun(iReportRun $reportRun)
    {
        $this->reportRuns->removeElement($reportRun);
    }

}