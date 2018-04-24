<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:34 PM
 */

namespace Micx\Core\App\Mw;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

trait MiddleWareContainer
{

    /**
     * @var Middleware[]
     */
    private $middlewares = [];

    public function addMiddleWare (MiddleWare $middleWare)
    {
        $this->middlewares[] = $middleWare;
    }

    protected function runMiddlewares (ServerRequest $request, Response $response) : Response
    {
        $next = new Next($this->middlewares, $this);
        return $next($request, $response);
    }

}