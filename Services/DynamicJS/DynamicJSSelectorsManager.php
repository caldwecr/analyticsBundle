<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:13 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Services\CympelManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsManager;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSSelectors;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSSelectorsManager extends CympelManager implements iDynamicJSSelectorsManager
{
    /**
     * @param $selectorArray
     * @return DynamicJSSelectors
     */
    public function createFromArray($selectorArray)
    {
        $selectors = $this->creator->create('DynamicJSSelectors');
        $selectorsCollection = new ArrayCollection();
        $called = 0;
        foreach($selectorArray as $key => $value) {
            $selectorsCollection[$key] = $this->creator->create('DynamicJSSelector');
            $created = time();
            self::configureSelector($selectorsCollection[$key], $value, $selectors, $created, $called);
        }
        $selectors->setSelectors($selectorsCollection);
        return $selectors;
    }

    /**
     * @param iDynamicJSSelector $selector
     * @param string $selection
     * @param iDynamicJSSelectors $parentSelectors
     * @param int $created
     * @param int $called
     */
    private static function configureSelector(iDynamicJSSelector $selector, $selection, iDynamicJSSelectors $parentSelectors, $created, $called)
    {
        $selector->setSelection($selection);
        $selector->setParentSelectors($parentSelectors);
        $selector->setCreated($created);
        $selector->setCalled($called);
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSSelectorsManager';
    }
}