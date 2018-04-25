<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 11:07 PM
 */

namespace Micx\Modules\Router\Config;



use Micx\Core\Serializer\ObjectUnserializerTrait;

class T_RouterConfig
{
    use ObjectUnserializerTrait;


    /**
     * @Serializer\Type("string")
     * @var
     */
    public $config_file = "micx-routes.yml";

}