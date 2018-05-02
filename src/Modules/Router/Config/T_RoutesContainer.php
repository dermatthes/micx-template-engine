<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 5/3/18
 * Time: 12:00 AM
 */

namespace Micx\Modules\Router\Config;


use Micx\Core\Serializer\ObjectUnserializerTrait;

class T_RoutesContainer
{
    use ObjectUnserializerTrait;

    const __META__ = [
        "properties" => [
            "routes" => [
                "type" => T_RouterConfig_Route::class,
                "array" => true
            ]
        ]
    ];

    /**
     * @var T_RouterConfig_Route[]
     */
    public $routes = [];
}