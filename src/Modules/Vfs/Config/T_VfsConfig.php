<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/30/18
 * Time: 2:07 AM
 */

namespace Micx\Modules\Vfs\Config;


use Micx\Core\Serializer\ObjectUnserializerTrait;

class T_VfsConfig
{
    use ObjectUnserializerTrait;

    const __META__ = [
        "properties" => [
            "search_path" => [
                "type" => "string",
                "map" => true
            ]
        ]
    ];

    /**
     * @var string[]
     */
    public $map;
}