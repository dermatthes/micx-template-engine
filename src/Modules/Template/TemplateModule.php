<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 10:33 PM
 */

namespace Micx\Modules\Template;


use Micx\Core\App\Application;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\App\Di\DiFactory;
use Micx\Core\App\Module;
use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Modules\Template\Config\T_TemplateConfig;

class TemplateModule implements Module
{

    public function _onConfigInit(ConfigFileFactory $configFileFactory)
    {
        $configFileFactory->registerParser(
            "template",
            function (array $data) {
                return T_TemplateConfig::Unserialize($data);
            },
            [
                "map" => [
                    "html"  => "text/html",
                    "txt"   => "text/plain"
                ]
            ]
        );
    }

    public function register(ApplicationFactory $applicationFactory)
    {
        $applicationFactory->addEventListener("config-init", 0, [$this, "_onConfigInit"]);

        $applicationFactory->addEventListener("app-init", 30, function (Application $application, ConfigFile $config) {
            $application->templateFactory = new DiFactory(function () {
                return new TemplateFactory();
            });
            $application->addMiddleWare(new TemplateMw($config->template));
        });
    }
}