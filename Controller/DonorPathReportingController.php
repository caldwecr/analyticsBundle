<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/20/13
 * Time: 9:42 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cympel\Bundle\AnalyticsBundle\Controller\Exception\UnableToGetReportException;

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

    public function getDonorPathRouteTrafficReport()
    {
        $reportName = 'DonorPathRouteTrafficReport';
        $report = $this->get('ca.generics.finder')->findOneByPropertyAndClassAlias(
            array(
                'name' => $reportName,
            ),
            'Report'
        );
        if(!$report) {
            // The report doesn't exist in the database so create it and persist it
            $creator = $this->get('ca.generics.creator');
            $report = $creator->create('Report');

            $report->setName($reportName);

            $query =    "SELECT rt
                        FROM CympelAnalyticsBundle:RouteTraffic rt
                        WHERE rt.name LIKE :name
                        AND rt.timestamp BETWEEN :start AND :end";
            $report->setQuery($query);

            $this->get('ca.generics.persister')->persist($report);
        }
        if(!$report) {
            throw new UnableToGetReportException();
        }
        return $report;
    }
}