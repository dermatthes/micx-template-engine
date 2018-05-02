<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 5/2/18
 * Time: 11:51 PM
 */

namespace Micx\Modules\Router;


use Micx\Core\App\Application;
use Micx\Core\App\Di\DiValue;
use Micx\Core\App\Mw\MiddleWare;
use Micx\Core\App\Mw\Next;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;

class RouterMw implements MiddleWare
{

    public function __invoke(ServerRequest $request, Response $response, Next $next, Application $app): Response
    {
        $app->set("origRequest", new DiValue($request, true));
        $app->set("request", new DiValue($request, false));
        $route = $app->router->findMatchingRoute($request->getUri()->getPath());
        if ($route === null) {
            return $next($request, $response);
        }

        $newRequest = $request->withUri(new Uri($route->target));
        $app->set("request", new DiValue($newRequest));

        return $next($newRequest, $response);
    }
}