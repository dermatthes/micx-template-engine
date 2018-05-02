<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:19 PM
 */

namespace Micx\Core\App;


use Micx\Core\App\Di\DiContainer;
use Micx\Core\App\Di\DiContainerTrait;
use Micx\Core\App\Mw\MiddleWareContainer;
use Micx\Core\App\Mw\Next;
use Micx\Core\Vfs\VirtualFileSystem;
use Micx\Modules\Mime\MimeMap;
use Micx\Modules\Router\Router;
use Micx\Modules\Template\TemplateFactory;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Stream;


/**
 * Class Application
 * @package Micx\Core\App
 *
 * @property VirtualFileSystem $virtualFileSystem
 * @property MimeMap $mimeMap
 * @property TemplateFactory $templateFactory
 * @property Router $router
 * @property ServerRequest $origRequest
 * @property ServerRequest $request
 */
class Application implements DiContainer
{
    use MiddleWareContainer, DiContainerTrait;

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
        if ($response instanceof Response\EmptyResponse)
            throw new \InvalidArgumentException("Empty response");
        $emiter = new SapiEmitter();
        $emiter->emit($response);
    }

}