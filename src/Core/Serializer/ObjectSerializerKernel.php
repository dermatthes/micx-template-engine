<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 2:45 AM
 */

namespace Micx\Core\Serializer;


use Micx\Core\Helper\Singleton;

class ObjectSerializerKernel
{
    use Singleton;


    private $validator = [];

    public function addValidator ($name, callable $callback)
    {
        $this->validator[$name] = $callback;
    }

    public function addPlugin (ObjectSerializerPlugin $plugin)
    {
        $plugin->register($this);
    }

    public function getMeta (string $classname) : array
    {
        $classRef = new \ReflectionClass($classname);
        $meta = ["properties" => []];
        do {
            if ( ! $classRef->hasConstant("__META__"))
                continue;
            $curMeta = $classRef->getConstant("__META__");
            if (is_string($curMeta))
                $curMeta = require $curMeta;
            $meta = array_merge($meta, $curMeta);
        } while (($classRef = $classRef->getParentClass()) !== false);
        return $meta;
    }


}