<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:51 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidAttemptToSetEntityCympelNamespace;
use Cympel\Bundle\ToolsBundle\Services\CympelService;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iNamespacer;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iPersister;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iValidator;
use Cympel\Bundle\AnalyticsBundle\Services\Exception\InvalidPersistableException;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;

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
     * @var iNamespacer
     */
    protected $namespacer;

    /**
     * @var string
     */
    protected static $classAlias = 'CympelPersister';

    /**
     * @var iNamespace
     */
    private $myNamespace;

    /**
     * @param Object $doctrine
     * @param iValidator $validator
     * @param iNamespacer $namespacer
     * @param string $namespaceName
     */
    public function __construct($doctrine, iValidator $validator, iNamespacer $namespacer, $namespaceName = '_blank')
    {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
        $this->namespacer = $namespacer;
        $this->myNamespace = $this->namespacer->findOrCreateNamespaceByName($namespaceName);
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
        if(!$persistable->getId()) {
            $em->persist($persistable);
            $em->flush();
        }

        // An entity must have a valid id before adding to a namespace
        // Continue from here .. the problem is that now the persister is trying to overwrite the
        // namespace set by the generateonetimestylesheet method
        // I think best approach is to just check to see if the entity already has a namespace,
        // to do that I have to make iPersistable extend iNamespaceable, which means an update to the tools bundle
        $cn = $persistable->getCympelNamespace();
        if(!$cn || !$cn->getName()) {
            $this->namespacer->addEntityToCympelNamespace($persistable, $this->myNamespace);
        }

        $em->persist($persistable);
        $em->flush();

    }

}