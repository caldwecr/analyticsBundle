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
     * @param DynamicCSS $tool
     * @param array $ids
     * @return DynamicCSSDomIdArrayCollection
     */
    public function create(DynamicCSS $tool, $ids)
    {
        $d = new DynamicCSSDomIdArrayCollection();
        foreach($ids as $key => $value) {
            $d[$key] = $this->dynamicCSSDomIdManager->create();
            $d[$key]->setDynamicCSS($tool);
            $d[$key]->setDomIdValue($value);
        }
        return $d;
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