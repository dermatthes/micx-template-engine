<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/13/18
 * Time: 12:53 AM
 */

namespace Micx\Core\Serializer;


class ObjectSerializer
{
    protected $curName = [];
    protected $curClass = "";

    protected function getPropertyConfig ($propertyName, array $meta)
    {
        $config = [
            "type" => "string",
            "required" => true,
            "array" => false,
            "map"   => false,
            "transient" => false,
            "validate" => null
        ];
        if (isset ($meta["properties"][$propertyName])) {
            $config = array_merge($config, $meta["properties"][$propertyName]);
        }
        return $config;
    }

    /**
     * @param $value
     * @param string $type
     * @return bool|int|mixed|string
     * @throws ObjectSerializerException
     */
    protected function castValue ($value, string $type)
    {
        switch ($type) {
            case "mixed":
                return $value;

            case "string":
                if ( ! is_string($value))
                    throw new ObjectSerializerException("expected: string", 200);
                return (string)$value;

            case "int":
                if ( ! is_int($value))
                    throw new ObjectSerializerException("expected: int", 201);
                return (int)$value;

            case "bool":
                if ( ! is_bool($value))
                    throw new ObjectSerializerException("expected: bool", 202);
                return (bool)$value;

            default:
                if ( ! class_exists($type))
                    throw new ObjectSerializerException("class not found: $type", 203);
                $obj = new $type();
                try {
                    return $this->_deserialize($value, $obj);
                } catch (ObjectSerializerException $e) {
                    $e->__setFailedClassName($type);
                    throw $e;
                }
        }
    }

    /**
     * @param $input
     * @param array $propConfig
     * @param $defaultValue
     * @return array|bool|int|mixed|string
     * @throws ObjectSerializerException
     */
    protected function buildValue($input, array $propConfig, $defaultValue)
    {
        if ($propConfig["transient"] === true)
            return $defaultValue;

        if ($input === null && $propConfig["required"] === true && $defaultValue === null)
            throw new ObjectSerializerException("required property missing", 100);

        if ($input === null)
            $input = $defaultValue;

        if ($propConfig["array"] || $propConfig["map"]) {
            if ( ! is_array($input))
                throw new ObjectSerializerException("array value expected", 101);
            $arrVal = [];
            foreach ($input as $key => $value) {
                try {
                    if ($propConfig["map"]) {
                        if (!is_string($key))
                            throw new ObjectSerializerException("map expected", 102);
                        $arrVal[$key] = $this->castValue($value, $propConfig["type"]);
                    } else {
                        if (!is_int($key))
                            throw new ObjectSerializerException("array expected", 103);
                        $arrVal[] = $this->castValue($value, $propConfig["type"]);
                    }
                } catch (ObjectSerializerException $e) {
                    $e->__addFailedPath($key);
                    throw $e;
                }
            }
            return $arrVal;
        }
        return $this->castValue($input, $propConfig["type"]);
    }

    /**
     * @param array $data
     * @param $targetObject
     * @return mixed
     * @throws ObjectSerializerException
     */
    protected function _deserialize (array $data, $targetObject)
    {
        $ref = new \ReflectionObject($targetObject);
        $meta = ObjectSerializerKernel::GetInstance()->getMeta($ref->getName());

        foreach ($ref->getProperties() as $curPropRef) {
            $curPropName = $curPropRef->getName();

            $value = null;
            if (isset ($data[$curPropName])) {
                $value = $data[$curPropName];
                unset ($data[$curPropName]);
            }
            try {
                $curPropRef->setValue(
                    $targetObject,
                    $this->buildValue(
                        $value,
                        $this->getPropertyConfig($curPropName, $meta),
                        $curPropRef->getValue($targetObject)
                    )
                );
            } catch (ObjectSerializerException $e) {
                if ($e->getFailedClass() === null) {
                    $e->__setFailedPropertyName($curPropName);
                    $e->__setFailedClassName($ref->getName());
                }
                $e->__addFailedPath($curPropName);
                throw $e;
            }
        }
        $rest = array_keys($data);
        if (count($rest) > 0) {
            $unrecognized = implode(", ", $rest);
            $e = new ObjectSerializerException("Unrecognized keys: '$unrecognized'");
            $e->__setFailedClassName($ref->getName());
            $e->__setFailedPropertyName($rest[0]);
            throw $e;
        }
        return $targetObject;
    }

    /**
     * @param array $inputArray
     * @param $targetObject
     * @return mixed
     * @throws ObjectSerializerException
     */
    public function deserialize (array $inputArray, $targetObject)
    {
        if (is_string($targetObject))
            $targetObject = new $targetObject();
        try {
            return $this->_deserialize($inputArray, $targetObject);
        } catch (ObjectSerializerException $intE) {
            $failedPath = implode(".", $intE->getFailedPath());
            $ee = new ObjectSerializerException("Failed Path '{$failedPath}': {$intE->getMessage()} (reported in {$intE->getFailedClass()}::{$intE->getFailedProperty()})", $intE->getCode());
            $ee->__pushIntoException($intE);
            throw $ee;
        }
    }

}