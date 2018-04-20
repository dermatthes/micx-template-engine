<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 3:08 AM
 */

return [
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
            "type" => \Test\_TB::class
        ]
    ]
];