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

    /**
     * @var DiRef[]
     */
    private $diRef = [];

    public function __get($name)
    {
        if ( ! isset ($this->diRef[$name]))
            throw new \InvalidArgumentException("Get '$name': Not set");
        return $this->diRef[$name]->resolve($this);
    }

    public function __set($name, $value)
    {
        if ( ! $value instanceof DiRef)
            throw new \InvalidArgumentException("Setting '$name': Value must be instance of DiRef");
        if (isset ($this->diRef[$name])) {
            if ($this->diRef[$name]->isProtected())
                throw new \InvalidArgumentException("Cannot set '$name': Is Protected");
        }
        $this->diRef[$name] = $value;
    }

    public function get(string $name)
    {
        return $this->__get($name);
    }

    public function has(string $name)
    {
        return isset ($this->diRef[$name]);
    }

    public function set(string $name, DiRef $reference)
    {
        $this->__set($name, $reference);
    }

}