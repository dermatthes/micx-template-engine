<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:20 PM
 */

namespace Micx\Core\App;


use Micx\Core\App\Di\DiValue;
use Micx\Core\Config\ConfigFile;
use Micx\Core\Config\ConfigFileFactory;
use Micx\Core\Helper\EventEmitterTrait;
use Micx\Core\Vfs\VirtualFileSystem;
use Symfony\Component\Yaml\Yaml;

class ApplicationFactory
{
    use EventEmitterTrait;


    /**
     * @var Module[]
     */
    private $modules = [];

    private $virtualFileSystem;

    public function __construct(VirtualFileSystem $virtualFileSystem)
    {
        $this->virtualFileSystem = $virtualFileSystem;
    }

    public function getVirtualFileSystem() : VirtualFileSystem
    {
        return $this->virtualFileSystem;
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


    public function build (array $configData) : Application
    {
        $configFileFactory = new ConfigFileFactory();
        $this->triggerEvent("config-init", $configFileFactory);
        $configFileFactory->build($configData, $config = new ConfigFile());

        // Caching vom Conifg-Object

        $application = new Application();
        $application->virtualFileSystem = new DiValue($this->virtualFileSystem, true);

        $this->triggerEvent("app-init", $application, $config);
        return $application;
    }

}