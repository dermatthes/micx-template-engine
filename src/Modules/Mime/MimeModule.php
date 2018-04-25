<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 9:46 PM
 */

namespace Micx\Modules\Mime;


use Micx\Core\App\Application;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\App\Di\DiContainer;
use Micx\Core\App\Di\DiFactory;
use Micx\Core\App\Module;
use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Modules\Mime\Config\T_MimeConfig;

class MimeModule implements Module
{
    public function _onConfigInit(ConfigFileFactory $configFileFactory)
    {
        $configFileFactory->registerParser(
            "mime",
            function (array $data) {
                return T_MimeConfig::Unserialize($data);
            },
            [
                "map" => [
                    "html"  => "text/html",
                    "txt"   => "text/plain"
                ]
            ]
        );
    }

    function _onAppInit(Application $application, ConfigFile $configFile)
    {
        $application->mimeMap = new DiFactory(
            function () use ($configFile) {
                return new MimeMap($configFile->mime);
            },
            true
        );
    }

    public function register(ApplicationFactory $applicationFactory)
    {
        $applicationFactory->addEventListener("config-init", 0, [$this, "_onConfigInit"]);
        $applicationFactory->addEventListener("app-init", 0, [$this, "_onAppInit"]);
    }
}