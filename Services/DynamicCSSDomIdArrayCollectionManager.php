<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 2:59 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomIdArrayCollection;

class DynamicCSSDomIdArrayCollectionManager extends TrackingToolManagerExtensionService
{

    /**
     * @var DynamicCSSDomIdManager
     */
    protected $dynamicCSSDomIdManager;

    public function __construct(DynamicCSSDomIdManager $dynamicCSSDomIdManager)
    {
        $this->dynamicCSSDomIdManager = $dynamicCSSDomIdManager;
    }


    /**
     * @param array $ids
     * @return DynamicCSSDomIdArrayCollection
     */
    public function create($ids)
    {
        $d = new DynamicCSSDomIdArrayCollection();
        $d->setTempIds($ids);
        return $d;
    }

    /**
     * @param DynamicCSSDomIdArrayCollection $collection
     * @param DynamicCSS $tool
     * @return DynamicCSSDomIdArrayCollection
     */
    public function attachTool(DynamicCSSDomIdArrayCollection $collection, DynamicCSS $tool)
    {
        $ids = $collection->getTempIds();
        foreach($ids as $key => $value) {
            $collection[$key] = $this->dynamicCSSDomIdManager->create();
            $collection[$key]->setDynamicCSS($tool);
            $collection[$key]->setDomIdValue($value);
        }
        return $collection;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSDomIdArrayCollectionManager';
    }

}