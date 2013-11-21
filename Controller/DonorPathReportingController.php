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

    /**
     * @param $start
     * @param $end
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function runRouteTrafficReportAction($start, $end)
    {
        // Setup the variables to be passed as arguments to the queueReport method
        $report = $this->getDonorPathRouteTrafficReport();
        $results = array();
        $parameters = array(
            'start' => $start,
            'end' => $end,
            'name' => '%DonorPath%',
        );
        $callbacks = array(
            'onRun' => null,
            'onCompletedSuccessfully' => null,
            'onAbend' => null,
        );
        // Queue the report
        $this->get('ca.report.manager')->queueReport($report, $results, $parameters, $callbacks);
        // Count the number of records in the results
        $shown = count($results);
        // Render the report
        return $this->render('CympelAnalyticsBundle:DonorPathReporting:routeTrafficReport.html.twig', array(
            'start' => $start,
            'end' => $end,
            'shown' => $shown,
        ));
    }

    /**
     * @param $start
     * @param $end
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function runRedirectReportAction($start, $end)
    {
        // Setup the variables to be passed as arguments to the queueReport method
        $report = $this->getDonorPathRedirectReport();
        $results = array();
        $parameters = array('start' => $start, 'end' => $end, 'name' => '%DonorPath%redirect%');
        $callbacks = null;
        // Queue the report
        $this->get('ca.report.manager')->queueReport($report, $results, $parameters, $callbacks);
        // Count the number of records in the results
        $numberOfRedirects = count($results);
        return $this->render('CympelAnalyticsBundle:DonorPathReporting:redirectReport.html.twig', array(
            'start' => $start,
            'end' => $end,
            'numberOfRedirects' => $numberOfRedirects,
        ));
    }

    public function runHoverReportAction($start, $end)
    {
        // Setup the variables to be passed as arguments to the queueReport method
        $report = $this->getDonorPathHoverReport();
        $results = array();
        $parameters = array('start' => $start, 'end' => $end, 'namespaceName' => 'DonorPath');
        // Queue the report
        $this->get('ca.report.manager')->queueReport($report, $results, $parameters);
        $numberOfHovers = count($results);
        return $this->render('CympelAnalyticsBundle:DonorPathReporting:hoverReport.html.twig', array(
            'start' => $start,
            'end' => $end,
            'numberOfHovers' => $numberOfHovers,
        ));
    }

    public function getDonorPathRouteTrafficReport()
    {
        $reportName = 'DonorPathRouteTrafficReport';
        $query =    "SELECT rt
                    FROM CympelAnalyticsBundle:RouteTraffic rt
                    WHERE rt.name LIKE :name
                    AND rt.timestamp BETWEEN :start AND :end";
        return $this->get('ca.report.manager')->findOrCreateReport($reportName, $query);
    }

    public function getDonorPathRedirectReport()
    {
        $reportName = 'DonorPathRedirectReport';
        $query =    "SELECT rt
                    FROM CympelAnalyticsBundle:RouteTraffic rt
                    WHERE rt.name LIKE :name
                    AND rt.timestamp BETWEEN :start AND :end";
        return $this->get('ca.report.manager')->findOrCreateReport($reportName, $query);
    }

    public function getDonorPathHoverReport()
    {
        $reportName = 'DonorPathHoverReport';
        $query =    "SELECT DISTINCT dynamicCSS
                    FROM CympelAnalyticsBundle:DynamicCSSDomId di
                    INNER JOIN CympelAnalyticsBundle:DynamicCSS dynamicCSS
                    WITH (di.dynamicCSS = dynamicCSS)
                    INNER JOIN CympelAnalyticsBundle:CympelNamespace cn
                    WITH (di.cympelNamespace = cn)
                    AND cn.name = :namespaceName
                    AND di.rendered BETWEEN :start AND :end";
        return $this->get('ca.report.manager')->findOrCreateReport($reportName, $query);
    }
}