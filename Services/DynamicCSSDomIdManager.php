<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 2:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicCSSDomId;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

class DynamicCSSDomIdManager implements iType
{
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @todo implement this method
     */
    public function createDynamicCSSDomId()
    {

    }

    /**
     * @todo implement this method
     */
    public function persistDynamicCSSDomId()
    {

    }

    /**
     * @todo implement this method
     */
    public function removeDynamicCSSDomId()
    {

    }

    /**
     * @param int $id
     *
     * @todo implement this method
     */
    public function findOneDynamicCSSDomIdById($id)
    {

    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @param string $domIdValue
     */
    public function findOneDynamicCSSDomIdByDynamicCSSAndDomIdValue(DynamicCSS $dynamicCSS, $domIdValue)
    {

    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSDomIdManager';
    }

}