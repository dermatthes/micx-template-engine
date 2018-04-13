<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 11:07 PM
 */

namespace Micx\Modules\Router\Config;


use JMS\Serializer\Annotation as Serializer;

class T_RouterConfig
{

    const __DEFAULT__ = [
        "config" => "micx-routes.yml"
    ];

    /**
     * @Serializer\Type("string")
     * @var
     */
    public $config;

}