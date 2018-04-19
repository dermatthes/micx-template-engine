<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 11:38 PM
 */

namespace Test;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\Config\MicxConfig;
use Micx\Core\Helper\ObjectSerializer;
use Micx\Core\Helper\ObjectSerializerTrait;
use Micx\Modules\Router\Config\T_RouterConfig;


require __DIR__ . "/../bootstrap.php";



class _TB {

    public $basicVal;


}


class _TA
{
    use ObjectSerializerTrait;

    const __META__ = [
        "properties" => [
            "basicVal" => [
                "type" => "string"
            ],
            "basicArrVal" => [
                "type" => "string",
                "array" => true
            ],
            "basicMapVal" => [
                "type" => "string",
                "map" => true
            ],
            "cpxVal" => [
                "type" => _TB::class
            ]
        ]
    ];

    public $basicVal;
    public $basicArrVal;
    public $basicMapVal;
    public $cpxVal;
}


$input = [
    "basicVal" => "A",
    "basicArrVal" => [
        "A", "B"
    ],
    "basicMapVal" => [
        "A"=>"A", "B"=>"B"
    ],
    "cpxVal" => [
        "basicVal" => "C"
    ]
];

print_r (_TA::Unserialize($input));



