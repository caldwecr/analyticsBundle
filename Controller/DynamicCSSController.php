<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 9:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DynamicCSSController extends Controller {

    public function dynamicCSSAction($key)
    {
        //convert $key into useful variables to pass to template
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcss = $dcm->renderDCSSById($key);
        $ids = $dcm->getDynamicCSSDomIds($dcss);
        return $this->render('CympelAnalyticsBundle:Default:dcss.css.twig', array(
            'ids' => $ids,
            'pseudo' => $dcss->getPseudo(),
        ));
    }

    public function dynamicCSSImageFileAction($key, $domIdValue)
    {
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcdim = $this->get('cympel_analytics.dynamic_css_dom_id_manager');
        $dynamicCSS = $dcm->findOneTimeStylesheetById($key);
        $dcdim->renderByDynamicCSSAndDomIdValue($dynamicCSS, $domIdValue);
        return new BinaryFileResponse('bundles/cympelanalytics/assets/images/logo.jpg');
    }
}