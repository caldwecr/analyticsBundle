<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 10:07 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelector;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectorDomEvent;
use Cympel\Bundle\AnalyticsBundle\Services\CympelFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorDomEventFinder;

class DynamicJSSelectorDomEventFinder extends CympelFinder implements iDynamicJSSelectorDomEventFinder
{

    /**
     * @param iDynamicJSSelector $selector
     * @param iDynamicJSDomEvent $domEvent
     * @param string $classAlias
     * @return iDynamicJSSelectorDomEvent
     */
    public function findOneBySelectorAndDomEvent(iDynamicJSSelector $selector, iDynamicJSDomEvent $domEvent, $classAlias)
    {
        $findable = $this->creator->create($classAlias);
        $repositoryName = $findable->getRepositoryName();
        $entityManagerName = $findable->getEntityManagerName();
        $repository = $this->doctrine->getRepository($repositoryName, $entityManagerName);
        $found = $repository->findOneBy(array(
            'selector' => $selector,
            'domEvent' => $domEvent,
        ));
        if($found) {
            $found->setRepositoryName($repositoryName);
            $found->setEntityManagerName($entityManagerName);
        }
        return $found;
    }
}