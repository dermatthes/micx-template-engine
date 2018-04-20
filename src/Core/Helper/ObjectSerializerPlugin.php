<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 3:07 AM
 */

namespace Micx\Core\Helper;


interface ObjectSerializerPlugin
{

    public function register (ObjectSerializerKernel $kernel);

}