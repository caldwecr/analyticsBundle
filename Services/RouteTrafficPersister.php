<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 8/21/13
 * Time: 9:22 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\RouteTraffic;
use Cympel\Bundle\ToolsBundle\Services\CympelService;

class RouteTrafficPersister extends CympelService implements iType
{
    protected $doctrine;

    protected $emName;

    /**
     * @var string
     */
    protected static $classAlias = 'RouteTrafficPersister';

    public function __construct($doctrine, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->emName = $entityManagerName;
    }

    /**
     * @param string $routeName - this should be a fully qualified route name
     */
    public function persist($routeName)
    {
        $rt = new RouteTraffic();
        $rt->setName($routeName);
        $rt->setTimestamp(time());
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($rt);
        $em->flush();
    }


    public function getEntityManagerName()
    {
        return $this->emName;
    }
}