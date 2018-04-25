<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:28 PM
 */

namespace Micx\Core\App\Di;


class DiValue implements DiRef
{

    private $value;
    private $isProtected;

    public function __construct($value, $isProtected = false)
    {
        $this->value = $value;
        $this->isProtected = $isProtected;
    }

    public function addFilter(callable $filter)
    {
        // TODO: Implement addFilter() method.
    }

    public function resolve(DiContainer $container)
    {
        return $this->value;
    }

    public function isProtected(): bool
    {
        return $this->isProtected;
    }
}