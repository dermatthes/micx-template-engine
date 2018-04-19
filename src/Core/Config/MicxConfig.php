<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:58 PM
 */

namespace Micx\Core\Config;


use Micx\Modules\Router\Config\T_RouterConfig;

class MicxConfig
{


    const __META__ = [
        "properties" => [
            "version" => [
                "type" => "int",
                "required" => true
            ],
            "modules" => [
                "type" => "array",
            ]
        ]
    ];

    /**
     * @Serializer\Type("string")
     * @var int
     */
    public $version;


    /**
     * @Serializer\Type("array")
     * @var array
     */
    public $modules = [];
}