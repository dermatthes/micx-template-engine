<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 11:07 PM
 */

namespace Micx\Modules\Router\Config;



use Micx\Core\Serializer\ObjectUnserializerTrait;

class T_RouterConfig extends T_RoutesContainer
{


    const __META__ = [
        "properties" => [
            "routes" => [
                "type" => T_RouterConfig_Route::class,
                "array" => true
            ]
        ]
    ];

    /**
     *
     * @var string
     */
    public $config_file = "micx-routes.yml";




}