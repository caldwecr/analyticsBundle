<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 8:39 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iRemovable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRemover;

class CympelRemover extends CympelService implements iRemover
{
    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param iRemovable $removable
     * @return void
     */
    public function remove(iRemovable $removable)
    {
        $em = $this->doctrine->getManager($removable->getEntityManagerName());
        $em->remove($removable);
        $em->flush();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelRemover';
    }

}