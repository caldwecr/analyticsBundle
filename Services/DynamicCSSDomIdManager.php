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
use Cympel\Bundle\AnalyticsBundle\Entity\InvalidDynamicCSSDomIdException;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

class DynamicCSSDomIdManager implements iType
{
    protected $doctrine;

    protected $validator;

    protected $emName;

    public function __construct($doctrine, $validator, $entityManagerName)
    {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
        $this->emName = $entityManagerName;
    }

    /**
     * @return DynamicCSSDomId
     */
    public function createDynamicCSSDomId()
    {
        return new DynamicCSSDomId();
    }

    /**
     * @return DynamicCSSDomId
     *
     * This method is an alias of ::createDynamicCSSDomId
     */
    public function create()
    {
        return $this->createDynamicCSSDomId();
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return DynamicCSSDomId
     */
    public function renderDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        $dynamicCSSDomId->setRendered(time());
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($dynamicCSSDomId);
        $em->flush();
        return $dynamicCSSDomId;
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return DynamicCSSDomId
     *
     * This method is an alias of ::renderDynamicCSSDomId
     */
    public function render(DynamicCSSDomId $dynamicCSSDomId)
    {
        return $this->renderDynamicCSSDomId($dynamicCSSDomId);
    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @param $domIdValue
     * @return DynamicCSSDomId
     */
    public function renderDynamicCSSDomIdByDynamicCSSAndDomIdValue(DynamicCSS $dynamicCSS, $domIdValue)
    {
        $dynamicCSSDomId = $this->findOneDynamicCSSDomIdByDynamicCSSAndDomIdValue($dynamicCSS, $domIdValue);
        return $this->renderDynamicCSSDomId($dynamicCSSDomId);
    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @param $domIdValue
     * @return DynamicCSSDomId
     *
     * This method is an alias of ::renderDynamicCSSDomIdByDynamicCSSAndDomIdValue
     */
    public function renderByDynamicCSSAndDomIdValue(DynamicCSS $dynamicCSS, $domIdValue)
    {
        return $this->renderDynamicCSSDomIdByDynamicCSSAndDomIdValue($dynamicCSS, $domIdValue);
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return bool
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\InvalidDynamicCSSDomIdException
     */
    public function persistDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        if(!$this->validate($dynamicCSSDomId)) {
            throw new InvalidDynamicCSSDomIdException();
        }
        $em = $this->doctrine->getManager($this->emName);
        $em->persist($dynamicCSSDomId);
        $em->flush();
        return true;
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return bool
     *
     * This method is an alias of ::persistDynamicCSSDomId
     */
    public function persist(DynamicCSSDomId $dynamicCSSDomId)
    {
        return $this->persistDynamicCSSDomId($dynamicCSSDomId);
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return bool
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\InvalidDynamicCSSDomIdException
     */
    public function removeDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        if(!$this->validate($dynamicCSSDomId)) {
            throw new InvalidDynamicCSSDomIdException();
        }
        $em = $this->doctrine->getManager($this->emName);
        $em->remove($dynamicCSSDomId);
        $em->flush();
        return true;
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return bool
     *
     * This method is an alias of ::removeDynamicCSSDomId
     */
    public function remove(DynamicCSSDomId $dynamicCSSDomId)
    {
        return $this->removeDynamicCSSDomId($dynamicCSSDomId);
    }

    /**
     * @param $id
     * @return DynamicCSSDomId
     */
    public function findOneDynamicCSSDomIdById($id)
    {
        $repository = $this->doctrine->getRepository('CympelAnalyticsBundle:DynamicCSSDomId', $this->emName);
        $dynamicCSSDomId = $repository->findOneById($id);
        return $dynamicCSSDomId;
    }

    /**
     * @param $id
     * @return DynamicCSSDomId
     *
     * This method is an alias of ::findOneByDynamicCSSDomIdById
     */
    public function findOneById($id)
    {
        return $this->findOneDynamicCSSDomIdById($id);
    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @param $domIdValue
     * @return DynamicCSSDomId
     */
    public function findOneDynamicCSSDomIdByDynamicCSSAndDomIdValue(DynamicCSS $dynamicCSS, $domIdValue)
    {
        $repository = $this->doctrine->getRepository('CympelAnalyticsBundle:DynamicCSSDomId', $this->emName);
        $dynamicCSSDomId = $repository->findOneBy(array(
            'dynamicCSS' => $dynamicCSS,
            'domIdValue' => $domIdValue,
        ));
        return $dynamicCSSDomId;
    }

    /**
     * @param DynamicCSS $dynamicCSS
     * @param $domIdValue
     * @return DynamicCSSDomId
     *
     * This method is an alias of ::findOneDynamicCSSDomIdByDynamicCSSAndDomIdValue
     */
    public function findOneByDynamicCSSAndDomIdValue(DynamicCSS $dynamicCSS, $domIdValue)
    {
        return $this->findOneDynamicCSSDomIdByDynamicCSSAndDomIdValue($dynamicCSS, $domIdValue);
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return array
     */
    public function validateDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        $errors = $this->validator->validate($dynamicCSSDomId);
        return $errors;
    }

    /**
     * @param DynamicCSSDomId $dynamicCSSDomId
     * @return array
     *
     * This method is an alias of ::validateDynamicCSSDomId
     */
    public function validate(DynamicCSSDomId $dynamicCSSDomId)
    {
        return $this->validateDynamicCSSDomId($dynamicCSSDomId);
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