<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/20/18
 * Time: 3:18 AM
 */

namespace Micx\Core\Helper;


trait Singleton
{
    private function __construct()
    {
    }

    private static $instance = null;
    public static function GetInstance() : self
    {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }
}