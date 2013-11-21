<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 9:42 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnknownReportAndBlankQueryException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnableToGetReportException;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iReport;

class DonorPathReportingController extends Controller
{
    public function dashboardAction($start, $end)
    {
        $shown = 1;
        $numberOfHoverInteractions = 2;
        $numberOfClicks = 3;
        $numberOfSubmissions = 4;
        $numberOfRedirections = 5;
        return $this->render('CympelAnalyticsBundle:DonorPathReporting:dashboard.html.twig', array(
            'start' => $start,
            'end' => $end,
            'shown' => $shown,
            'numberOfHoverInteractions' => $numberOfHoverInteractions,
            'numberOfClicks' => $numberOfClicks,
            'numberOfSubmissions' => $numberOfSubmissions,
            'numberOfRedirections' => $numberOfRedirections,
        ));
    }

    public function runRouteTrafficReportAction($start, $end)
    {
        $name = '%DonorPath%';
        $report = $this->getDonorPathRouteTrafficReport();
        $reportRun = $this->get('ca.generics.creator')->create('ReportRun');

        $report->addRun($reportRun);
        $reportRun->setStatus('new');
        $reportRun->setParameters(array(
            'start' => $start,
            'end' => $end,
            'name' => $name,
        ));
        $reportRun->setReport($report);
        $reportRunNumber = $this->get('ca.report.runner')->queueRun($reportRun);
        $resultData = $reportRun->getResult()->getData();
        $shown = count($resultData);
        return $this->render('CympelAnalyticsBundle:DonorPathReporting:routeTrafficReport.html.twig', array(
            'start' => $start,
            'end' => $end,
            'shown' => $shown,
        ));
    }

    public function runRedirectReportAction($start, $end)
    {
        $name = '%DonorPath%redirect%';
        $report = $this->getDonorPathRedirectReport();
        $reportRun = $this->get('ca.generics.creator')->create('ReportRun');

        $report->addRun($reportRun);
        $reportRun->setStatus('new');
        $reportRun->setParameters(array(
            'start' => $start,
            'end' => $end,
            'name' => $name,
        ));
        $reportRun->setReport($report);
        $reportRunNumber = $this->get('ca.report.runner')->queueRun($reportRun);
        $resultData = $reportRun->getResult()->getData();
        $numberOfRedirects = count($resultData);
        return $this->render('CympelAnalyticsBundle:DonorPathReporting:redirectReport.html.twig', array(
            'start' => $start,
            'end' => $end,
            'numberOfRedirects' => $numberOfRedirects,
        ));
    }

    public function getDonorPathRouteTrafficReport()
    {
        $reportName = 'DonorPathRouteTrafficReport';
        $query =    "SELECT rt
                    FROM CympelAnalyticsBundle:RouteTraffic rt
                    WHERE rt.name LIKE :name
                    AND rt.timestamp BETWEEN :start AND :end";
        return $this->getReport($reportName, $query);
    }

    public function getDonorPathRedirectReport()
    {
        $reportName = 'DonorPathRedirectReport';
        $query =    "SELECT rt
                    FROM CympelAnalyticsBundle:RouteTraffic rt
                    WHERE rt.name LIKE :name
                    AND rt.timestamp BETWEEN :start AND :end";
        return $this->getReport($reportName, $query);
    }

    /**
     * @param $reportName
     * @param null $reportQuery
     * @return iReport
     * @throws Exception\UnableToGetReportException
     * @throws Exception\UnknownReportAndBlankQueryException
     */
    protected function getReport($reportName, $reportQuery = null)
    {
        $report = $this->get('ca.generics.finder')->findOneByPropertyAndClassAlias(
            array(
                'name' => $reportName,
            ),
            'Report'
        );
        if(!$report) {
            if(!$reportQuery) {
                throw new UnknownReportAndBlankQueryException();
            }
            // The report doesn't exist in the database so create it and persist it
            $creator = $this->get('ca.generics.creator');
            $report = $creator->create('Report');
            $report->setName($reportName);
            $report->setQuery($reportQuery);
            $this->get('ca.generics.persister')->persist($report);
        }
        if(!$report) {
            throw new UnableToGetReportException();
        }
        return $report;
    }
}