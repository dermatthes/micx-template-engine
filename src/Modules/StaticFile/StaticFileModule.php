<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 11:08 PM
 */

namespace Micx\Modules\StaticFile;


use Micx\Core\App\Application;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\App\Module;

class StaticFileModule implements Module
{

    public function register(ApplicationFactory $applicationFactory)
    {

    }

    public function onApplicationBuild(Application $application)
    {
        $application->addMiddleWare(new StaticFileMw("wurst"));
    }
}