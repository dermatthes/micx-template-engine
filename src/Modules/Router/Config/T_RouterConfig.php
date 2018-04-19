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
    /**
     * @Serializer\Type("string")
     * @var
     */
    public $configFile = "micx-routes.yml";

}