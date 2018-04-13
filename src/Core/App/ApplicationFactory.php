<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:20 PM
 */

namespace Micx\Core\App;


use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Micx\Core\Config\MicxConfig;
use Symfony\Component\Yaml\Yaml;

class ApplicationFactory
{

    /**
     * @var SerializerBuilder
     */
    private $jmsBuilder;

    private $modules = [];

    public function __construct()
    {
        // Used unless upgrade to DoctrineAnnotations >=2.0.0
        AnnotationRegistry::registerLoader("class_exists");
        $this->jmsBuilder = SerializerBuilder::create();
    }

    public function getJmsBuilder() : SerializerBuilder
    {
        return $this->jmsBuilder;
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
        return $serializer->deserialize($parsed, MicxConfig::class, "array");
    }




    public function build ($configFile) : Application
    {}

}