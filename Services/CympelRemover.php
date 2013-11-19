<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 8:39 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\ToolsBundle\Services\CympelService;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;

class CympelRemover extends CympelService implements iRemover
{
    /**
     * @var string
     */
    protected static $classAlias = 'CympelRemover';

    /**
     * @var iNamespacer
     */
    protected $namespacer;

    /**
     * @var iNamespace
     */
    protected $myNamespace;

    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @param Object $doctrine
     * @param iNamespacer $namespacer
     * @param string $namespaceName
     */
    public function __construct($doctrine, iNamespacer $namespacer, $namespaceName = '_blank')
    {
        $this->doctrine = $doctrine;
        $this->namespacer = $namespacer;
        $this->myNamespace = $this->namespacer->findOrCreateNamespaceByName($namespaceName);
    }

    /**
     * @param iRemovable $removable
     * @return void
     */
    public function remove(iRemovable $removable)
    {
        $em = $this->doctrine->getManager($removable->getEntityManagerName());
        $this->namespacer->removeEntityFromCympelNamespace($removable, $this->myNamespace);
        $em->remove($removable);
        $em->flush();
    }
}