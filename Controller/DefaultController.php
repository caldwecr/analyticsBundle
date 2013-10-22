<?php

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CympelAnalyticsBundle:Default:index.html.twig', array('name' => $name));
    }

    public function dynamicCSSAction($key)
    {
        //convert $key into useful variables to pass to template
        return $this->render('CympelAnalyticsBundle:Default:dcss.css.twig');
    }
}
