<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:53 PM
 */

namespace Frontend;

use Micx\Core\App\ApplicationFactory;
use Micx\Core\Vfs\VirtualFileSystem;
use Micx\Modules\Mime\MimeModule;
use Micx\Modules\Router\RouterModule;
use Micx\Modules\StaticFile\StaticFileModule;
use Micx\Modules\Template\TemplateModule;
use Micx\Modules\Vfs\VfsModule;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . "/../vendor/autoload.php";


$factory = new ApplicationFactory($vfs = VirtualFileSystem::Build(__DIR__ ."/../demo"));
$factory->registerAvailableModule(new MimeModule());
$factory->registerAvailableModule(new RouterModule());
$factory->registerAvailableModule(new StaticFileModule());
$factory->registerAvailableModule(new TemplateModule());
$factory->registerAvailableModule(new VfsModule());


$application = $factory->build($vfs->withFileName("micx.yml"));


$application->serve();