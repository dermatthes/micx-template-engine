<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/30/18
 * Time: 2:07 AM
 */

namespace Micx\Modules\Template\Config;


use Micx\Core\Serializer\ObjectUnserializerTrait;

class T_TemplateConfig
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

    /**
     * @var string[]
     */
    public $map;
}