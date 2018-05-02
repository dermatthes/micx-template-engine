<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 5/2/18
 * Time: 11:41 PM
 */

namespace Micx\Modules\Router\Config;


class T_RouterConfig_Route
{

    const __META__ = [
        "properties" => [
            "match" => [
                "type" => "string",
                "map" => true
            ]
        ]
    ];


    public $name;
    public $target;
    public $match;
}