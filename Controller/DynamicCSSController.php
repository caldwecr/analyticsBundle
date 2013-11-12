<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 9:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DynamicCSSController extends Controller {

    // This method is called to generate and deliver the dynamic css file to the client
    // We have to use dynamic references to the images at this point to prevent browser caching
    public function dynamicCSSAction($key, $cympelNamespace = '_blank')
    {
        //convert $key into useful variables to pass to template
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcss = $dcm->renderById('DynamicCSS', $key);
        $ids = $dcm->getDynamicCSSDomIds($dcss);

        // set non-cacheable redirects uri for DynamicCSSImage s
        // use fKey so as not to override function scoped key
        foreach($ids as $fKey => $value) {
            $image = $value->getImage();
            if($image) {
                $oldUri = $image->getImageUri();
                $newUri = $this->generateUrl('dynamicCSSImageFile', array(
                   'key' => $key,
                    'domIdValue' => $value->getDomIdValue(),
                    'imageId' => $image->getId(),
                ));
                $image->setUncacheableImageUri($newUri);
            }
        }
        $response = $this->render('CympelAnalyticsBundle:Default:dcss.css.twig', array(
            'ids' => $ids,
            'pseudo' => $dcss->getPseudo(),
        ));
        $response->headers->set('Content-Type', 'text/css');
        return $response;
    }

    public function dynamicCSSImageFileRedirectAction($imageId)
    {
        $finder = $this->get('cympel_analytics.generics.finder');
        $dynamicCSSImage = $finder->findOneByIdAndClassAlias($imageId, DynamicCSS::getClassAlias());
        $uri = $dynamicCSSImage->getImageUri();
        return $this->render('CympelAnalytics:Default:index.html.twig');
        //return $this->redirect($uri);
    }

    public function dynamicCSSImageFileAction($key, $domIdValue, $imageId = 0, $cympelNamespace = '_blank')
    {
        if($imageId && is_numeric($imageId)) {
            $imageId = (int) $imageId;
        }
// ??? What's wrong that is causing it to be uncallable?!
        if(!is_int($imageId)) {
            throw new \Exception("The imageId argument (#3) to the method dynamicCSSImageFileAction must be of type int");
        }
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcdim = $this->get('cympel_analytics.dynamic_css_dom_id_manager');
        $dynamicCSS = $dcm->findOneTimeStylesheetById('DynamicCSS', $key);
        $dcdim->renderByDynamicCSSAndDomIdValue($dynamicCSS, $domIdValue);
        return $this->forward('CympelAnalyticsBundle:Default:dynamicCSSImageFileRedirect', array(
            'imageId' => $imageId,
        ));
    }
}