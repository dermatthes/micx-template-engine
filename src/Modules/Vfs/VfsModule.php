<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 10:33 PM
 */

namespace Micx\Modules\Vfs;


use Micx\Core\App\Application;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\App\Di\DiFactory;
use Micx\Core\App\Module;
use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Modules\Template\Config\T_TemplateConfig;
use Micx\Modules\Vfs\Config\T_VfsConfig;

class VfsModule implements Module
{

    public function _onConfigInit(ConfigFileFactory $configFileFactory)
    {
        $configFileFactory->registerParser(
            "vfs",
            function (array $data) {
                return T_VfsConfig::Unserialize($data);
            },
            [
                "search_path" => [
                    "./", "/_pages/", "/_elements/", "/_includes/"
                ]
            ]
        );
    }

    public function register(ApplicationFactory $applicationFactory)
    {
        $applicationFactory->addEventListener("config-init", 0, [$this, "_onConfigInit"]);

        $applicationFactory->addEventListener("app-init", 0, function (Application $application, ConfigFile $config) {
            $application->virtualFileSystem->setSearchPath($config->vfs->search_path);
        });
    }
}