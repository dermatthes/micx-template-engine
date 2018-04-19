<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 1:21 AM
 */

namespace Micx\Core\Helper;


trait ObjectSerializerTrait
{

    /**
     * @param array $data
     * @return self
     * @throws ObjectSerializerException
     */
    public static function Unserialize(array $data) : self
    {
        $sz = new ObjectSerializer();
        return $sz->deserialize($data, self::class);
    }

    public static function UnserializeYaml($yamlInput) : self
    {

    }

    public static function UnserializeJson($jsonInput) : self
    {

    }
}