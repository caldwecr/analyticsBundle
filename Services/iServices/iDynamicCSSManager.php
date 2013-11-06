<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/6/13
 * Time: 1:42 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

interface iDynamicCSSManager extends iManager
{
    /**
     * @param array $ids - an array of DOM id's that the stylesheet should include trackers for
     * @param string $pseudo - which pseudo class the stylesheet should bind its tracking to
     * @param string $namespaceName - optional parameter will attach the stylesheet and associated entities to the namespace specified by the namespaceName,
     *  if the namespace does not already exist it will be created
     * @return string
     *
     * The method returns a URI to the created stylesheet
     */
    public function generateOneTimeStylesheet($ids = array(), $pseudo, $namespaceName = '_blank');
}