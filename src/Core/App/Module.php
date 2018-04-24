<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:56 PM
 */

namespace Micx\Core\App;


interface Module
{
    public function register (ApplicationFactory $applicationFactory);
}