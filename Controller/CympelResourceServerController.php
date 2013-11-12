<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 10:53 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Cympel\Bundle\AnalyticsBundle\Controller\iController\iResourceServerController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CympelResourceServerController extends Controller implements iResourceServerController
{
    public function imageAction($imageId = null)
    {
        $fullFileName = $this->get('ca.generics.resource_server')->getResourceFileName($imageId);
        if(!$fullFileName || $fullFileName == '_blank') $fullFileName = '/favicon.ico';
        return new BinaryFileResponse($fullFileName);
    }
}