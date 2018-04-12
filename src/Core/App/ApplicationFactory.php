<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/12/18
 * Time: 9:20 PM
 */

namespace Micx\Core\App;


class ApplicationFactory
{
    /**
     * Register the Plugins (not activation)
     *
     * This determines the order of initialisation
     *
     * @param $plugin
     */
    public function registerAvailableModule ($className)
    {

    }





    public function build ($configFile) : Application
    {}

}