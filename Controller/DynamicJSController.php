<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 11:40 AM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DynamicJSController extends Controller
{
    public function dynamicJSAction($key)
    {
        //return a url of a dynamic JS file
        $djm = $this->get('cympel_analytics.dynamic_js_manager');

        $dj = $djm->renderById('DynamicJS', $key);

        //$ids = $dcm->getDynamicCSSDomIds($dcss);

        $selectors = $djm->getDynamicJSelectors($dj);

        $events = $djm->getDynamicJDomEvents($dj);

        return $this->render('CympelAnalyticsBundle:DynamicJS:djs.js.twig', array(
            'selectors' => $selectors,
            'events' => $events,
        ));
    }

    public function dynamicJSCallbackAction()
    {
        //return a message received / success message
    }
}