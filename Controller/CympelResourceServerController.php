<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 10:53 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CympelResourceServerController extends Controller
{
    public function imageAction($fullFileName = null)
    {
        if(!$fullFileName || $fullFileName == '_blank') $fullFileName = '/favicon.ico';
        return new BinaryFileResponse($fullFileName);
    }
}