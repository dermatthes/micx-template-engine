<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:39 PM
 */

namespace Micx\Core\Vfs;


class VirtualFile extends VirtualPath
{



    public function getExtension() : string
    {
        return pathinfo($this->curDir)["extension"];
    }

    public function getBaseName() : string
    {
        return pathinfo($this->curDir)["basename"];
    }

    public function getFileName() : string
    {
        return pathinfo($this->curDir)["filename"];
    }


    public function getContents () : string
    {
        file_get_contents($this->curDir);
    }

    public function getYaml () : array
    {
        $ret = yaml_parse_file($this->curDir);
        return $ret;
    }

    public function getJSON () : array
    {
        $ret = json_decode($this->getContents(), true);
        return $ret;
    }

    public function fopen ()
    {

    }


}