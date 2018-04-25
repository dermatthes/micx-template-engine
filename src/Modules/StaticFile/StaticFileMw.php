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
use Micx\Core\Vfs\PathNotFoundException;
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

    /**
     * @param ServerRequest $request
     * @param Response $response
     * @param Next $next
     * @param Application $app
     * @return Response
     * @throws \Micx\Core\Vfs\PathOutOfBoundsException
     */
    public function __invoke(ServerRequest $request, Response $response, Next $next, Application $app): Response
    {
        try {
            $file = $app->virtualFileSystem->withFileName($request->getUri()->getPath());
            $contentType = $app->mimeMap->getMimeTypeByExtension($file->getExtension());
            $response = new Response\HtmlResponse(new Stream($file->fopen()), 200, ["Content-Type" => $contentType]);
            return $response;
        } catch (PathNotFoundException $e) {
            return $next($request, $response);
        }
    }
}