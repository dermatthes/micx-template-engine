<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 1:21 AM
 */

namespace Micx\Core\Helper;


use Symfony\Component\Yaml\Yaml;

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

    /**
     * @param $yamlInput
     * @return self
     * @throws ObjectSerializerException
     * @throws \ErrorException
     */
    public static function UnserializeYaml($yamlInput) : self
    {
        if (function_exists("yaml_parse")) {
            $data = yaml_parse($yamlInput);
        } elseif (class_exists("Symfony\Component\Yaml\Yaml")) {
            $data = Yaml::parse($yamlInput);
        } else {
            throw new \ErrorException("Your installation is missing a YAML parser. Please install yaml pecl extension or require Symfonys YAML Parser (composer require symfony/yaml)");
        }
        $sz = new ObjectSerializer();
        return $sz->deserialize($data, self::class);
    }

    public static function UnserializeJson($jsonInput) : self
    {

    }
}