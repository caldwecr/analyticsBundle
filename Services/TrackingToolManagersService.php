<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 10:49 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

class TrackingToolManagersService implements iType
{
    /**
     * @var DynamicJSManager
     */
    protected $dynamicJSManager;

    /**
     * @var DynamicCSSManager
     */
    protected $dynamicCSSManager;

    public function __construct(DynamicCSSManager $dynamicCSSManager, DynamicJSManager $dynamicJSManager)
    {
        $this->dynamicCSSManager = $dynamicCSSManager;
        $this->dynamicJSManager = $dynamicJSManager;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'TrackingToolManagersService';
    }


    public function removeTools(iTracker $tracker)
    {
        $tools = $tracker->getTrackingTools();
        foreach($tools as $key => $value)
        {
            $typeName = $value->getType();
            if($typeName === 'DynamicCSS') {
                $this->dynamicCSSManager->remove($value);
            } else if($typeName === 'DynamicJS') {
                $this->dynamicJSManager->remove($value);
            }
        }
    }
}