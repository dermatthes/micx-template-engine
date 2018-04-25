<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 9:23 PM
 */

namespace Micx\Core\App\Di;


interface DiContainer
{
    public function __get($name);

    public function __set($name, $value);

    public function get(string $name);

    public function has(string $name);

    public function set(string $name, DiRef $reference);
}