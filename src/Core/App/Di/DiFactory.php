<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:29 PM
 */

namespace Micx\Core\App\Di;


class DiFactory implements DiRef
{

    private $value = null;
    private $isResolved = false;
    private $factory;
    private $isProtected;


    public function __construct(callable $factory, bool $isProtected)
    {
        $this->factory = $factory;
        $this->isProtected = $isProtected;
    }

    public function isProtected(): bool
    {
        return $this->isProtected;
    }

    public function addFilter(callable $filter)
    {
        // TODO: Implement addFilter() method.
    }

    public function resolve(DiContainer $container)
    {
        if ( ! $this->isResolved) {
            $this->value = ($this->factory)($container);
            $this->isResolved = true;
        }
        return $this->value;
    }
}