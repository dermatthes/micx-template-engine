<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:35 PM
 */

namespace Micx\Core\App\Mw;


use Micx\Core\App\Application;

interface MiddleWare
{

    public function run (Request $request, Response $response, Next $next, Application $app);

}