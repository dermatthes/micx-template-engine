<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:21 PM
 */

namespace Micx\Core\App\Di;


trait DiContainer
{

    private $diRef = [];

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        throw new \InvalidArgumentException("Cannot set di-components");
    }

    public function get(string $name)
    {

    }

    public function has(string $name)
    {

    }

    public function set(string $name, DiRef $reference)
    {

    }

}