<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:20 PM
 */

namespace Micx\Core\App;


use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Core\Helper\EventEmitterTrait;
use Symfony\Component\Yaml\Yaml;

class ApplicationFactory
{
    use EventEmitterTrait;


    /**
     * @var Module[]
     */
    private $modules = [];


    public function __construct()
    {
    }


    /**
     * Register the Plugins (not activation)
     *
     * This determines the order of initialisation
     *
     * @param $plugin
     * @return ApplicationFactory
     */
    public function registerAvailableModule (Module $module) : self
    {
        $module->register($this);
        return $this;
    }




    public function buildConfig (string $data)
    {
        $parsed = Yaml::parse($data);
        return $parsed;
    }




    public function build (array $configData) : Application
    {
        $configFileFactory = new ConfigFileFactory();
        $this->triggerEvent("config-init", $configFileFactory);
        $configFileFactory->build($configData, $config = new ConfigFile());

        // Caching vom Conifg-Object

        $application = new Application();
        $this->triggerEvent("app-init", $application, $config);
        return $application;
    }

}