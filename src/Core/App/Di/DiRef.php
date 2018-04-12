<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:27 PM
 */

namespace Micx\Core\App\Di;


interface DiRef
{

    public function addFilter (callable $filter);

    public function resolve(DiContainer $container);

}