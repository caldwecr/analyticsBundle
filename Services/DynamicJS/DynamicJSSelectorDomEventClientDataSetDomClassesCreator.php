<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 7:19 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEventClientDataSet;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorDomEventClientDataSetDomClassesCreator;
use Doctrine\Common\Collections\ArrayCollection;
use Cympel\Bundle\AnalyticsBundle\Services\CympelCreator;

class DynamicJSSelectorDomEventClientDataSetDomClassesCreator extends CympelCreator implements iDynamicJSSelectorDomEventClientDataSetDomClassesCreator
{
    public function createClassesFromJSONAndDataSet($json, iDynamicJSSelectorDomEventClientDataSet $dataSet, $classAlias, $classesAlias)
    {
        $classes = $this->create($classesAlias);
        $classes->setDataSet($dataSet);
        $classesArray = array();
        $d = json_decode($json, true);
        if($d && array_key_exists('classList', $d) && is_array($d['classList'])) {
            foreach($d['classList'] as $key => $value) {
                if($key !== 'length') {
                    $class = $this->create($classAlias);
                    $class->setClassName($value);
                    $class->setParentClasses($classes);
                    $classesArray[] = $class;
                }
            }
        }
        $classesArrayCollection = new ArrayCollection($classesArray);
        $classes->setClasses($classesArrayCollection);
        return $classes;
    }

}