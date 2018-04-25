<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 9:49 PM
 */

namespace Micx\Modules\Mime\Config;


use Micx\Core\Serializer\ObjectUnserializerTrait;

class T_MimeConfig
{
    use ObjectUnserializerTrait;

    const __META__ = [
        "properties" => [
            "map" => [
                "type" => "string",
                "map" => true
            ]
        ]
    ];

    public $map = [];
}