<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:20 PM
 */

namespace Micx\Core\App;


use Symfony\Component\Yaml\Yaml;

class ApplicationFactory
{



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
        $this->modules[] = $module;
        $module->register($this);
        return $this;
    }


    public function buildConfig (string $data)
    {
        $serializer = $this->jmsBuilder->build();
        $parsed = Yaml::parse($data);
        return $parsed;
    }




    public function build ($configFile) : Application
    {
        $application = new Application();
        foreach ($this->modules as $module)
            $module->onApplicationBuild($application);
        return $application;
    }

}