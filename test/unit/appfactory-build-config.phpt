<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 11:38 PM
 */

namespace Test;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Micx\Core\App\ApplicationFactory;
use Micx\Core\Config\MicxConfig;
use Micx\Modules\Router\Config\T_RouterConfig;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . "/../bootstrap.php";


//$factory = new ApplicationFactory();
$yaml = file_get_contents("data/micx.yml");


/*
$encoders = [new XmlEncoder(), new JsonEncoder(), new YamlEncoder()];
$normalizers = array(new ObjectNormalizer());

$serializer = new Serializer($normalizers, $encoders);
*/

AnnotationRegistry::registerLoader("class_exists");
$builder = SerializerBuilder::create();
$serializer = $builder->build();

print_r ($serializer->fromArray([], T_RouterConfig::class));
