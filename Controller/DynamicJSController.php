<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 11:40 AM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DynamicJSController extends Controller
{
    public function dynamicJSAction($key)
    {
        //return a url of a dynamic JS file
        $djm = $this->get('cympel_analytics.dynamic_js_manager');
        $dj = $djm->renderById('DynamicJS', $key);
        $selectors = $djm->getDynamicJSelectors($dj);

        $events = $djm->getDynamicJDomEvents($dj);
        $selectorList = '';
        $isFirst = true;
        foreach($selectors as $k => $value) {
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
        $response =  $this->render('CympelAnalyticsBundle:DynamicJS:djsFull.js.twig', array(
            'selectors' => $selectors,
            'events' => $events,
            'callbackUrl' => $callbackUrl,
        ));
        $response->headers->set('Content-Type', 'text/javascript');
        return $response;
    }

    public function dynamicJSCallbackAction(Request $request, $key, $selectorKey, $eventKey)
    {
        //generate a selectorevent entity and persist it
        //@todo create a test of the selectordomeventmanager persist, find, remove functionality
        $selectorDomEventManager = $this->get('cympel_analytics.generics.manager');
        $selectorManager = $this->get('cympel_analytics.dynamic_js_selector_manager');
        $domEventManager = $this->get('cympel_analytics.dynamic_js_dom_event.manager');
        //$selectorDomEvent = $selectorDomEventManager->getCreator()->create('DynamicJSSelectorDomEvent');
        $selector = $selectorManager->getFinder()->findOneByIdAndClassAlias($selectorKey, 'DynamicJSSelector');
        $domEvent = $domEventManager->findOneByEventKeyAndSelector($eventKey, $selector, 'DynamicJSDomEvent');

        //$selectorDomEvent->setSelector($selector);
        //$selectorDomEvent->setDomEvent($domEvent);
        $json = $request->get('q');
        // @todo implement captureClientDataSet method and test(s)
        $selectorDomEventManager->captureClientDataSet($selector, $domEvent, $json);
        //$selectorDomEventManager->getPersister()->persist($selectorDomEvent);


        //make sure the rendered property of the DynamicJS is set
        $dynamicJ = $selector->getParentSelectors()->getDynamicJ();
        $dynamicJRendered = $dynamicJ->getRendered();
        if(!$dynamicJRendered) {
            $dynamicJ->setRendered(time());
        }
        // defer persisting $dynamicJ ... persisting DynamicJSSelector will cascade
        //make sure the called property of the DynamicJSSelector is set
        $selectorCalled = $selector->getCalled();
        if(!$selectorCalled) {
            $selector->setCalled(time());
            $selectorManager->getPersister()->persist($selector);
        }
        //return a response
        $response = new Response("Success");
        return $response;
    }
}