<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:53 PM
 */

namespace Frontend;

use Micx\Core\App\ApplicationFactory;
use Micx\Modules\Router\RouterModule;
use Micx\Modules\StaticFile\StaticFileModule;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . "/../vendor/autoload.php";


$factory = new ApplicationFactory();
$factory->registerAvailableModule(new RouterModule());
$factory->registerAvailableModule(new StaticFileModule());

$application = $factory->build(yaml_parse_file(__DIR__ . "/../test/ref_page/micx.yml"));


$application->serve();