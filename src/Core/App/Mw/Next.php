<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:40 PM
 */

namespace Micx\Core\App\Mw;


use Micx\Core\App\Application;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class Next
{

    private $middlewares;
    private $application;

    public function __construct(array $middleWares, Application $application)
    {
        $this->middlewares = $middleWares;
        $this->application = $application;
    }


    public function __invoke(ServerRequest $request, Response $response) : Response
    {
        if (count ($this->middlewares) == 0)
            return $response;
        $curMiddleWare = array_shift($this->middlewares);
        return $curMiddleWare($request, $response, $this, $this->application);
    }
}