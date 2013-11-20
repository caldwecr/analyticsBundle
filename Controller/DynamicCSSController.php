<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 9:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Controller;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSImage;
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

    /**
     * @param $imageId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * This method redirects the client to the cacheable Image URI
     */
    public function dynamicCSSImageFileRedirectAction($imageId)
    {
        $finder = $this->get('ca.generics.finder');
        $dynamicCSSImage = $finder->findOneByIdAndClassAlias($imageId, DynamicCSSImage::getClassAlias());
        $uri = $dynamicCSSImage->getImageUri();
        return $this->redirect($uri);
    }

    /**
     * @param $key
     * @param $domIdValue
     * @param int $imageId
     * @param string $cympelNamespace
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     *
     * This method forwards the imageId to dynamicCSSImageFileRedirectAction
     * This method is where a client is pointed when requesting an uncacheable image
     */
    public function dynamicCSSImageFileAction($key, $domIdValue, $imageId = 0, $cympelNamespace = '_blank')
    {

        if($imageId && is_numeric($imageId)) {
            $imageId = (int) $imageId;
        }
        if(!is_int($imageId)) {
            throw new \Exception("The imageId argument (#3) to the method dynamicCSSImageFileAction must be of type int");
        }
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcdim = $this->get('cympel_analytics.dynamic_css_dom_id_manager');
        $dynamicCSS = $dcm->findOneTimeStylesheetById('DynamicCSS', $key);
        $dcdim->renderByDynamicCSSAndDomIdValue($dynamicCSS, $domIdValue);
        return $this->forward('CympelAnalyticsBundle:DynamicCSS:dynamicCSSImageFileRedirect', array(
            'imageId' => $imageId,
        ));
    }
}