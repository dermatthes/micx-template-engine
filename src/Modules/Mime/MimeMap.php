<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 9:52 PM
 */

namespace Micx\Modules\Mime;


use Micx\Modules\Mime\Config\T_MimeConfig;

class MimeMap
{

    private $config;

    public function __construct(T_MimeConfig $config)
    {
        $this->config = $config;
    }

    public function getMimeTypeByExtension(string $extension) : string
    {
        if (isset ($this->config->map[$extension]))
            return $this->config->map[$extension];
        if (isset ($this->config->map["*"]))
            return $this->config->map["*"];
        throw new \InvalidArgumentException("No MimeType for extension '$extension'");
    }


}