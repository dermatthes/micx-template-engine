<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 11:09 PM
 */

namespace Micx\Modules\StaticFile;


use Micx\Core\App\Application;
use Micx\Core\App\Mw\MiddleWare;
use Micx\Core\App\Mw\Next;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Stream;

class StaticFileMw implements MiddleWare
{

    private $rootDir;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function __invoke(ServerRequest $request, Response $response, Next $next, Application $app): Response
    {
        $dir = $this->rootDir . "/" . $request->getUri()->getPath();
        $response = new Response\HtmlResponse("Hello world! $dir");

        return $next($request, $response);
    }
}