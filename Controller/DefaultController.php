<?php

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CympelAnalyticsBundle:Default:index.html.twig', array('name' => $name));
    }

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
        return new BinaryFileResponse('bundles/cympelanalytics/assets/images/logo.jpg');
    }
}
