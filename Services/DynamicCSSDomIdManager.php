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

    protected $validator;

    public function __construct($doctrine, $validator)
    {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
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
     *
     * @todo implement this method
     */
    public function findOneDynamicCSSDomIdByDynamicCSSAndDomIdValue(DynamicCSS $dynamicCSS, $domIdValue)
    {

    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return bool
     */
    public function validateDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        $errors = $this->validator->validate($dynamicCSSDomId);
        return count($errors) == 0;
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