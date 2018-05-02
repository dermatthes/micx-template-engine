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
use Micx\Core\App\Di\DiFactory;
use Micx\Core\App\Module;
use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Core\Vfs\VirtualFile;
use Micx\Modules\Router\Config\T_RouterConfig;
use Micx\Modules\Router\Config\T_RouterConfig_Route;
use Micx\Modules\Router\Config\T_RoutesContainer;

class RouterModule implements Module
{

    public function _onConfigInit(ConfigFileFactory $configFileFactory, VirtualFile $curConfigFile)
    {
        $configFileFactory->registerParser(
            "router",
            function (array $data) use ($curConfigFile) {
                $config = T_RouterConfig::Unserialize($data);
                if ($config->config_file !== null) {
                    $extConfigFile = T_RoutesContainer::Unserialize($curConfigFile->withFileName($config->config_file)->getYaml());
                    foreach ($extConfigFile->routes as $curRoute)
                        $config->routes[] = $curRoute;

                }
                return $config;
            },
            []
        );
    }

    function _onAppInit(Application $application, ConfigFile $configFile)
    {
        $application->set("router", new DiFactory(function () use ($configFile) {
            return new Router($configFile->router);
        }));
        $application->addMiddleWare(new RouterMw());
    }

    public function register(ApplicationFactory $applicationFactory)
    {
        $applicationFactory->addEventListener("config-init", 1, [$this, "_onConfigInit"]);
        $applicationFactory->addEventListener("app-init", 20, [$this, "_onAppInit"]);
    }
}