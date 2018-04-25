<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 11:05 PM
 */

namespace Micx\Modules\Router;


use Micx\Core\App\Application;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\App\Module;
use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Modules\Router\Config\T_RouterConfig;

class RouterModule implements Module
{

    public function _onConfigInit(ConfigFileFactory $configFileFactory)
    {
        $configFileFactory->registerParser(
            "router",
            function (array $data) {
                return T_RouterConfig::Unserialize($data);
            },
            []
        );
    }

    function _onAppInit(Application $application, ConfigFile $configFile)
    {

    }

    public function register(ApplicationFactory $applicationFactory)
    {
        $applicationFactory->addEventListener("config-init", 1, [$this, "_onConfigInit"]);
        $applicationFactory->addEventListener("app-init", 50, [$this, "_onAppInit"]);
    }
}