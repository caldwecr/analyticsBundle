<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 3:08 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

class DynamicCSSServiceExtension extends TrackingToolManagerExtensionService
{
    /**
     * @var DynamicCSSDomIdManager
     */
    protected $dynamicCSSDomIdManager;

    /**
     * @var DynamicCSSDomIdArrayCollectionManager
     */
    protected $dynamicCSSDomIdArrayCollectionManager;

    public function __construct(DynamicCSSDomIdManager $dynamicCSSDomIdManager, DynamicCSSDomIdArrayCollectionManager $dynamicCSSDomIdArrayCollectionManager)
    {
        $this->dynamicCSSDomIdManager = $dynamicCSSDomIdManager;
        $this->dynamicCSSDomIdArrayCollectionManager = $dynamicCSSDomIdArrayCollectionManager;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\DynamicCSSDomIdArrayCollectionManager
     */
    public function getDynamicCSSDomIdArrayCollectionManager()
    {
        return $this->dynamicCSSDomIdArrayCollectionManager;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\DynamicCSSDomIdManager
     */
    public function getDynamicCSSDomIdManager()
    {
        return $this->dynamicCSSDomIdManager;
    }



    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSServiceExtension';
    }

}