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
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;

class DynamicCSSDomIdArrayCollectionManager extends TrackingToolManagerExtensionService
{

    /**
     * @var DynamicCSSDomIdManager
     */
    protected $dynamicCSSDomIdManager;

    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSDomIdArrayCollectionManager';

    public function __construct(DynamicCSSDomIdManager $dynamicCSSDomIdManager, iCreator $creator)
    {
        $this->dynamicCSSDomIdManager = $dynamicCSSDomIdManager;
        $this->creator = $creator;
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
    public function attachToolToDynamicCSSDomIds(DynamicCSSDomIdArrayCollection $collection, DynamicCSS $tool)
    {
        $ids = $collection->getTempIds();
        foreach($ids as $key => $value) {
            $collection[$key] = $this->dynamicCSSDomIdManager->create();
            $collection[$key]->setDynamicCSS($tool);
            if(is_array($value)) {
                $collection[$key]->setDomIdValue($value['id']);
                $image = $this->creator->create('DynamicCSSImage');
                $image->setName($value['id']);
                $image->setImageUri($value['imageUri']);
                $collection[$key]->setImage($image);
            } else {
                $collection[$key]->setDomIdValue($value);
            }
        }
        return $collection;
    }
}