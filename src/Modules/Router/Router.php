<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 5/2/18
 * Time: 11:53 PM
 */

namespace Micx\Modules\Router;


use Micx\Modules\Router\Config\T_RoutesContainer;

class Router
{

    /**
     * @var array|Config\T_RouterConfig_Route[]
     */
    private $routes = [];


    public function __construct(T_RoutesContainer $config)
    {
        $this->routes = $config->routes;
    }

    /**
     * @param string $path
     * @return Config\T_RouterConfig_Route|null
     */
    public function findMatchingRoute (string $path)
    {
        foreach ($this->routes as $curRoute) {
            if ($path == $curRoute->match["*"])
                return $curRoute;
        }
    }

}