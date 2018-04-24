<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:11 PM
 */

namespace Micx\Core\Vfs;


class VirtualFileSystem
{

    protected $rootDir;

    protected function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function select(string $path) : VirtualFile
    {
        return new VirtualFile($path, $this);
    }

    public static function Build ($rootDir) : VirtualFileSystem
    {

    }

}