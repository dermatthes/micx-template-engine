<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:11 PM
 */

namespace Micx\Core\Vfs;


class VirtualFileSystem extends VirtualPath
{

    protected function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
        $this->curDir = $rootDir;
    }


    public static function Build ($rootDir) : VirtualFileSystem
    {

        return new self(realpath($rootDir));
    }

}