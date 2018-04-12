<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:34 PM
 */

namespace Micx\Core\App\Mw;


trait MiddleWareContainer
{

    /**
     * @var Middleware[]
     */
    private $middlewares = [];

    public function addMiddleWare (MiddleWare $middleWare)
    {

    }


}