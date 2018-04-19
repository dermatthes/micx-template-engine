<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 12:17 AM
 */

namespace Micx\Core\Helper;


use Throwable;

class ObjectSerializerException extends \Exception
{

    private $failedPath = [];
    private $failedClassName = null;
    private $failedPropertyName = null;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __addFailedPath($name)
    {
        $this->failedPath[] = $name;
    }

    public function __setFailedClassName ($class)
    {
        $this->failedClassName = $class;
    }

    public function __setFailedPropertyName ($propName)
    {
        $this->failedPropertyName = $propName;
    }



    /**
     * Build a meaningful Exception
     *
     * @return self
     */
    public function __pushIntoException (self $intE)
    {
        $intE->failedPropertyName = $this->failedPropertyName;
        $intE->failedClassName = $this->failedClassName;
        $intE->failedPath = $this->failedPath;
    }


    public function getFailedPath() : array
    {
        return array_reverse($this->failedPath);
    }

    public function getFailedProperty()
    {
        return $this->failedPropertyName;
    }

    public function getFailedClass () {
        return $this->failedClassName;
    }


}