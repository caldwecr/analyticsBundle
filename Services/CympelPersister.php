<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:51 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\InvalidPersistableException;

class CympelPersister extends CympelService implements iPersister
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var iValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelPersister';

    public function __construct($doctrine, iValidator $validator)
    {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
    }

    /**
     * @param iPersistable $persistable
     * @throws Exception\InvalidPersistableException
     * @return void
     */
    public function persist(iPersistable $persistable)
    {
        if(!$this->validator->isValid($persistable)) {
            $errors = $this->validator->validate($persistable);
            throw new InvalidPersistableException($errors[0]);
        }
        $emName = $persistable->getEntityManagerName();
        $em = $this->doctrine->getManager($emName);
        $em->persist($persistable);
        $em->flush();
    }
}