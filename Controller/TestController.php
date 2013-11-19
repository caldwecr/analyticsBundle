<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 2:33 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSPropertySet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function dynamicCSSTestAction()
    {
        $ids = array(
            array(
                'id' => 'number_one',
                'imageUri' => $this->get('cympel_tools.generics.resource_server')->getUri('testImage.png'),
            ),
            'number_two',
            'number_three',
        );
        $pseudo = 'hover';
        $dcm = $this->get('ca.dcss.manager');
        $cssUrl = $dcm->generateOneTimeStylesheet($ids, $pseudo);
        return $this->render('CympelAnalyticsBundle:Test:test.html.twig', array(
            'cssUrl' => $cssUrl,
        ));
    }

    public function dynamicJSTestAction()
    {
        $selectors = array(
            '#number_one',
            '.firstClass',
            'div',
        );
        $targetEvents = array(
            'click',
        );
        $djm = $this->get('ca.djs.manager');
        $jsUrl = $djm->generateOneTimeJavascript('DynamicJS', $selectors, $targetEvents);

        return $this->render('CympelAnalyticsBundle:Test:jsTest.html.twig', array(
            'jsUrl' => $jsUrl,
        ));

    }
}