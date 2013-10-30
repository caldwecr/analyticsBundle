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
use Symfony\Component\BrowserKit\Response;


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
        $selectorList = '';
        $isFirst = true;
        foreach($selectors as $key => $value) {
            if(!$isFirst) {
                $selectorList .= ', ';
            } else {
                $isFirst = false;
            }
            $selectorList .= $value->getSelection();
        }
        $callbackUrl = $this->generateUrl('dynamicJSCallbackShortUrl', array(
            'key' => $key,
            'selectorKey' => 'sKS', // This literal 'sKS' and 'eKS' below are matched by the javascript on the client for routing
            'eventKey' => 'eKS',
        ));
        $response =  $this->render('CympelAnalyticsBundle:DynamicJS:djs.js.twig', array(
            'selectors' => $selectors,
            'events' => $events,
            'callbackUrl' => $callbackUrl,
        ));
        $response->headers->set('Content-Type', 'text/javascript');
        return $response;
    }

    public function dynamicJSCallbackAction($key, $selectorKey, $eventKey)
    {
        //generate a selectorevent entity and persist it

        //make sure the rendered property of the DynamicJS is set

        //make sure the called property of the DynamicJSSelector is set

        //return a response
        return new Response();
    }
}