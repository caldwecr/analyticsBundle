<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 10:04 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomId;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DynamicCSSManager implements iType
{

    protected $doctrine;

    protected $router;

    public function __construct($doctrine, $router)
    {
        $this->doctrine = $doctrine;
        $this->router = $router;
    }

    /**
     * @param array $ids - an array of DOM id's that the stylesheet should include trackers for
     * @param string $pseudo - which pseudo class the stylesheet should bind its tracking to
     * @return string
     *
     * The method returns a URI to the created stylesheet
     */
    public function generateOneTimeStylesheet($ids, $pseudo)
    {
        $dCSS = new DynamicCSS();
        $dCSSDomIds = new ArrayCollection();
        foreach($ids as $key => $value) {
            $dCSSDomIds[$key] = new DynamicCSSDomId();
            $dCSSDomIds[$key]->setDynamicCSS($dCSS);
            $dCSSDomIds[$key]->setDomIdValue($value);
        }
        $dCSS->setDynamicCSSDomIds($dCSSDomIds);
        $dCSS->setPseudo($pseudo);
        $em = $this->doctrine->getManager();
        $em->persist($dCSS);
        $em->flush();
        return $this->router->generate('dynamicCSS',
            array(
                'key' => $dCSS->getId(),
            ),
            URLGeneratorInterface::ABSOLUTE_PATH
        );
    }

    /**
     * @param DynamicCSS $dynamicCSS
     */
    public function removeOneTimeStylesheet(DynamicCSS $dynamicCSS)
    {
        $em = $this->doctrine->getManager();
        $em->remove($dynamicCSS);
        $em->flush();
    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @return array
     *
     * This method is included so that the url property of the DynamicCSSDomId class can be populated even though this field is not persisted to the database
     *  and thus accessed via the twig template at render time.
     */
    public function getDynamicCSSDomIds(DynamicCSS $dynamicCSS)
    {
        $ids = $dynamicCSS->getDynamicCSSDomIds()->toArray();
        foreach($ids as $key => $value) {
            $value->setUrl(
                $this->router->generate('dynamicCSSImageFile',
                    array(
                        'key' => $dynamicCSS->getId(),
                        'domIdValue' => $value->getDomIdValue(),
                    ),
                    URLGeneratorInterface::ABSOLUTE_PATH
                )
            );
        }
        return $ids;
    }


    /**
     * @param $id
     * @return DynamicCSS
     *
     */
    public function findOneTimeStylesheetById($id)
    {
        $repository = $this->doctrine->getRepository('CympelAnalyticsBundle:DynamicCSS');
        $dcss = $repository->findOneById($id);
        return $dcss;
    }

    /**
     * @param $id
     * @return mixed
     *
     * This method is invoked by the Default Controller to render a DynamicCSS
     */
    public function renderDCSSById($id)
    {
        $toReturn = $this->findOneTimeStylesheetById($id);
        $toReturn->setRendered(time());
        $em = $this->doctrine->getManager();
        $em->persist($toReturn);
        $em->flush();
        return $toReturn;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSManager';
    }

}