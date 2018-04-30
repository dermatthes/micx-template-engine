<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:58 PM
 */

namespace Micx\Core\Config;


use Micx\Modules\Router\Config\T_RouterConfig;

class ConfigFileFactory
{

    private $builders = [];


    public function registerParser(string $section, callable $builder, array $default=null)
    {
        $this->builders[$section] = [$builder, $default];
    }


    public function build(array $input, ConfigFile $targetConfigFile )
    {
        foreach (get_class_vars(get_class($targetConfigFile)) as $key => $default) {
            if ( ! isset ($input[$key])) {
                if ($default !== null) {
                    $targetConfigFile->$key = $default;
                } else {
                    throw new \InvalidArgumentException("Missing required section '$key'");
                }
            } else {
                $targetConfigFile->$key = $input[$key];
                unset($input[$key]);
            }
        }

        foreach ($this->builders as $key => $call) {
            $default = $call[1]; $builder = $call[0];
            if ( ! isset ($input[$key]) && $default === null)
                continue;
            $data = [];
            if ($default !== null)
                $data = $default;
            if (isset ($input[$key]))
                $data = array_merge($data, $input[$key]);
            $targetConfigFile->$key = $builder($data);
            unset ($input[$key]);
        }
        if (count($input) > 0)
            throw new \InvalidArgumentException("Unrecognized section: " . implode(",", array_keys($input)));
    }

}