<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/24/18
 * Time: 9:39 PM
 */

namespace Micx\Core\Vfs;


class VirtualFile extends VirtualFileSystem
{
    private $vfs;
    private $path;

    protected function __construct(string $path, VirtualFileSystem $vfs)
    {
        $this->path = $path;
        $this->vfs = $vfs;
    }


    public function getExtension() : string
    {

    }

    public function getBaseName() : string
    {

    }

    public function fileExists () : bool
    {

    }

    public function getContents () : string
    {

    }


}