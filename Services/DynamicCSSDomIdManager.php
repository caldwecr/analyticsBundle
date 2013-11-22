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
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicCSSDomIdManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iExtender;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;

class DynamicCSSDomIdManager extends TrackingToolManagerExtensionService implements iDynamicCSSDomIdManager
{
    /**
     * @var iCreator
     */
    protected $creator;

    /**
     * @var iFinder
     */
    protected $finder;

    /**
     * @var iNamespacer
     */
    protected $namespacer;

    /**
     * @var iPersister
     */
    protected $persister;

    /**
     * @var iRemover
     */
    protected $remover;

    /**
     * @var iValidator
     */
    protected $validator;

    /**
     * @var iExtender
     */
    protected $extender;

    /**
     * @var string
     */
    protected static $classAlias = 'DynamicCSSDomIdManager';

    /**
     * @param iCreator $creator
     * @param iFinder $finder
     * @param iNamespacer $namespacer
     * @param iPersister $persister
     * @param iRemover $remover
     * @param iValidator $validator
     * @param iExtender $extender
     */
    public function __construct(iCreator $creator, iFinder $finder, iNamespacer $namespacer, iPersister $persister, iRemover $remover, iValidator $validator, iExtender $extender = null)
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->namespacer = $namespacer;
        $this->persister = $persister;
        $this->remover = $remover;
        $this->validator = $validator;
        $this->extender = $extender;
    }


    /**
     * @return DynamicCSSDomId
     */
    public function createDynamicCSSDomId()
    {
        return $this->getCreator()->create('DynamicCSSDomId');
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
        $this->getPersister()->persist($dynamicCSSDomId);
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
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidDynamicCSSDomIdException
     */
    public function persistDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        $this->getPersister()->persist($dynamicCSSDomId);
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
     * @throws \Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidDynamicCSSDomIdException
     */
    public function removeDynamicCSSDomId(DynamicCSSDomId $dynamicCSSDomId)
    {
        $this->getRemover()->remove($dynamicCSSDomId);
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
        $dynamicCSSDomId = $this->getFinder()->findOneByIdAndClassAlias($id, 'DynamicCSSDomId');
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
        $dynamicCSSDomId = $this->getFinder()->findOneByPropertyAndClassAlias(
            array(
                'dynamicCSS' => $dynamicCSS,
                'domIdValue' => $domIdValue,
            ),
            'DynamicCSSDomId'
        );
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
        $errors = $this->getValidator()->validate($dynamicCSSDomId);
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
     * @return iCreator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return iFinder
     */
    public function getFinder()
    {
        return $this->finder;
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

    /**
     * @return iRemover
     */
    public function getRemover()
    {
        return $this->remover;
    }

    /**
     * @return iValidator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return iExtender
     */
    public function getExtender()
    {
        return $this->extender;
    }

    /**
     * @param iExtender $extension
     * @return void
     */
    public function processExtension(iExtender $extension)
    {
        // This method is not used as the manager does not currently have an extension
    }


}