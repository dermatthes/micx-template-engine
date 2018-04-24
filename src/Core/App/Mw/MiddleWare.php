<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:35 PM
 */

namespace Micx\Core\App\Mw;


use Micx\Core\App\Application;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

interface MiddleWare
{

    public function __invoke(ServerRequest $request, Response $response, Next $next, Application $app) : Response;

}