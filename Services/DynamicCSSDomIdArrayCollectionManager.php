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
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iHaveNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersist;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;

class DynamicCSSDomIdArrayCollectionManager extends TrackingToolManagerExtensionService implements iPersist, iHaveNamespacer
{

    /**
     * @var DynamicCSSDomIdManager
     */
    protected $dynamicCSSDomIdManager;

    /**
     * @var iNamespacer
     */
    protected $namespacer;

    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var iPersister
     */
    protected $persister;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSDomIdArrayCollectionManager';

    public function __construct(DynamicCSSDomIdManager $dynamicCSSDomIdManager, iCreator $creator, iPersister $persister, iNamespacer $namespacer)
    {
        $this->dynamicCSSDomIdManager = $dynamicCSSDomIdManager;
        $this->creator = $creator;
        $this->persister = $persister;
        $this->namespacer = $namespacer;
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
            $toolNamespace = $tool->getCympelNamespace();
            $dynamicCSSDomIdNamespace = $collection[$key]->getCympelNamespace();
            if(is_array($value)) {
                $collection[$key]->setDomIdValue($value['id']);
                $image = $this->creator->create('DynamicCSSImage');
                $image->setName($value['id']);
                $image->setImageUri($value['imageUri']);
                $collection[$key]->setImage($image);
            } else {
                $collection[$key]->setDomIdValue($value);
            }
            if($toolNamespace && !$dynamicCSSDomIdNamespace) {
                // This isn't going to work because the dynamicCSSDomId hasn't been persisted yet
                $this->getPersister()->persist($collection[$key]);
                $this->namespacer->addEntityToCympelNamespace($collection[$key], $tool->getCympelNamespace());
            }
        }
        return $collection;
    }

    /**
     * @return iNamespacer
     */
    public function getNamespacer()
    {
        return $this->namespacer;
    }

    /**
     * @return iPersister
     */
    public function getPersister()
    {
        return $this->persister;
    }
}