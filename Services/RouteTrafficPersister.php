<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 8/21/13
 * Time: 9:22 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\RouteTraffic;

class RouteTrafficPersister extends CympelService implements iType
{
    protected $doctrine;

    protected $emName;

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'RouteTrafficPersister';
    }

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