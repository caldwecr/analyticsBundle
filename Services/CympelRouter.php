<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/1/13
 * Time: 2:17 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Symfony\Component\Routing\Router;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRouter;

class CympelRouter extends CympelService implements iRouter
{
    /**
     * @var Router
     */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param string $name
     * @param mixed $parameters
     * @param bool|string $referenceType
     * @return string
     */
    public function generate($name, $parameters = array(), $referenceType = Router::ABSOLUTE_PATH)
    {
        return $this->router->generate($name, $parameters, $referenceType);
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'CympelRouter';
    }

}