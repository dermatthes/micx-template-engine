<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 1:23 AM
 */

namespace Micx\Core\Config;


use Micx\Core\Serializer\ObjectUnserializerTrait;

class ConfigFile
{
    use ObjectUnserializerTrait;

    const __META__ = [
        "properties" => [
            "version" => [
                "type" => "string"
            ]
        ]
    ];
    public $version = "";


}