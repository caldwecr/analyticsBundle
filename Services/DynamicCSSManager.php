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
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicCSSManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DynamicCSSManager extends RoutedTrackingToolManager implements iDynamicCSSManager
{
    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSManager';

    /**
     * @param array $ids
     * @param string $pseudo
     * @param string $namespaceName
     * @return string
     */
    public function generateOneTimeStylesheet($ids = array(), $pseudo, $namespaceName = '_blank')
    {
        $classAlias = DynamicCSS::getClassAlias();
        $properties = new DynamicCSSPropertySet();
        $properties->setIds($this->getExtender()->getDynamicCSSDomIdArrayCollectionManager()->create($ids));
        $properties->setPseudo($pseudo);
        return $this->generate($classAlias, $properties, $this->getTrackerManager()->create());
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
        foreach ($ids as $key => $value) {
            $value->setUrl(
                $this->getRouter()->generate('dynamicCSSImageFile',
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
     * @param string $classAlias
     * @param $id
     * @return DynamicCSS
     *
     */
    public function findOneTimeStylesheetById($classAlias, $id)
    {
        return $this->getFinder()->findOneByIdAndClassAlias($id, $classAlias);
    }

    /**
     * @return iPropertySet
     */
    protected function createPropertySet()
    {
        return new DynamicCSSPropertySet();
    }

    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomIdArrayCollection|iPropertySet
     *
     * The purpose of this method is to allow changes to the properties based on the tool's initialization
     * that would have otherwise been impossible prior to the tool's initialization
     * This is necessary for DynamicCSS tools so that the DomIds can be bound to the tool
     */
    protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool)
    {
        return $this->attachToolToProperties($properties, $tool);
    }

    /**
     * @param DynamicCSSPropertySet $properties
     * @param iTrackingTool $tool
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomIdArrayCollection
     */
    private function attachToolToProperties(DynamicCSSPropertySet $properties, iTrackingTool $tool)
    {
        /**
         * This is necessary because the DynamicCSSDomIdArrayCollection needs to associate each DynamicCSSDomId with the tool
         */
        $dynamicCSSDomIdArrayCollection = $properties->getIds();
        $this->getExtender()->getDynamicCSSDomIdArrayCollectionManager()->attachToolToDynamicCSSDomIds($dynamicCSSDomIdArrayCollection, $tool);
        return $properties;
    }


    /**
     * @return string
     */
    protected function getRouteName()
    {
        return 'dynamicCSS';
    }

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    protected function getRoutingArray(iTrackingTool $tool)
    {
        return array(
            'key' => $tool->getId(),
        );
    }
}