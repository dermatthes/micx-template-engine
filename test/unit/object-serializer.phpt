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
use Micx\Core\Serializer\ObjectSerializer;
use Micx\Core\Serializer\ObjectUnserializerTrait;
use Micx\Modules\Router\Config\T_RouterConfig;


require __DIR__ . "/../bootstrap.php";



class _TB {

    public $basicVal;


}


class _TA
{
    use ObjectUnserializerTrait;

    const __META__ = __DIR__ . "/_TA.meta.php";

    public $unsetVal = "abc";
    public $basicVal;
    public $basicArrVal;
    public $basicMapVal;
    public $cpxVal;
    public $cpxValArr = [];
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
    ],
    "cpxValArr" => [
        [
            "basicVal" => "schmuh"
        ]
    ]
];

print_r (_TA::Unserialize($input));



