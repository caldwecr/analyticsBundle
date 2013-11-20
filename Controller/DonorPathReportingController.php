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
}