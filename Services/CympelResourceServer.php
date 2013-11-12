<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 10:34 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iResourceServer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CympelResourceServer extends CympelService implements iResourceServer
{

    protected $resources;

    protected $nameToResourceIdMap;

    protected $router;

    /**
     * @var string
     */
    protected $resourceDirectory;

    public function __construct($router)
    {
        $this->router = $router;
        $this->loadResources();
    }

    private function loadResources()
    {
        $this->resourceDirectory = __DIR__ . '/../Resources/servables';
        $resourceList = scandir($this->resourceDirectory);
        $this->resources = array();
        $this->nameToResourceIdMap = array();
        $currentId = 0;
        foreach($resourceList as $key => $value) {
            if(is_file($this->resourceDirectory . '/' . $value)) {
                $this->resources[$currentId] = $this->resourceDirectory . '/' . $value;
                $this->nameToResourceIdMap[$value] = $currentId;
                $currentId++;
            }
        }

    }

    public function getUri($resourceName)
    {
        return $this->router->generate(
            'cympel_resource_server_image',
            array(
                'imageId' => $this->nameToResourceIdMap[$resourceName],
            ),
            URLGeneratorInterface::ABSOLUTE_PATH
        );
    }

    /**
     * @return mixed
     */
    public function getResources()
    {
        return $this->resources;
    }

    public function getResourceFileName($imageId)
    {
        return $this->resources[$imageId];
    }
}