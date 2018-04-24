<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:53 PM
 */

namespace Frontend;

use Micx\Core\App\ApplicationFactory;
use Micx\Modules\StaticFile\StaticFileModule;

require __DIR__ . "/../vendor/autoload.php";


$factory = new ApplicationFactory();
$factory->registerAvailableModule(new StaticFileModule());

$application = $factory->build("");


$application->serve();