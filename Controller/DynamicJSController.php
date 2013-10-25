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
        //$dcss = $dcm->renderDCSSById($key);
        $djc = $djm->renderById($key);
        //$ids = $dcm->getDynamicCSSDomIds($dcss);
        $ids = null;
        return $this->render('CympelAnalyticsBundle:Default:dcss.css.twig', array(
            'ids' => $ids,
            'pseudo' => $dcss->getPseudo(),
        ));
    }

    public function dynamicJSCallbackAction()
    {
        //return a message received / success message
    }
}