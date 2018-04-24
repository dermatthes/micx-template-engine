<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:19 PM
 */

namespace Micx\Core\App;


use Micx\Core\App\Di\DiContainer;
use Micx\Core\App\Mw\MiddleWareContainer;
use Micx\Core\App\Mw\Next;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Stream;

class Application
{
    use MiddleWareContainer, DiContainer;

    public function dispatch(ServerRequest $request) : Response
    {
        $response = new Response\EmptyResponse();
        $response = $this->runMiddlewares($request, $response);
        return $response;
    }

    public function serve(ServerRequest $serverRequest = null)
    {
        if ($serverRequest === null)
            $serverRequest = ServerRequestFactory::fromGlobals();
        $response = $this->dispatch($serverRequest);
        $emiter = new SapiEmitter();
        $emiter->emit($response);
    }

}