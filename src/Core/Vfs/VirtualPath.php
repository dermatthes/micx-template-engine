<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 4/25/18
 * Time: 6:57 PM
 */

namespace Micx\Core\Vfs;


class VirtualPath
{

    protected $rootDir;

    protected $curDir;


    public function getPath() : string
    {
        return $this->rootDir . "/" . $this->curDir;
    }

    public function fileExists () : bool
    {
        return file_exists($this->getPath());
    }

    public function withPath (string $newPath) : self
    {
        $relDir = $this->curDir . "/" . $newPath;
        if ( ! is_dir($relDir))
            throw new PathNotFoundException("Path $relDir not found.");
        $realPath = realpath($relDir);
        if ($realPath === false)
            throw new PathOutOfBoundsException("Path '$newPath' not resolvable.");
        if (strpos($realPath, $this->rootDir) !== 0)
            throw new PathOutOfBoundsException("Path '$newPath' outside root directory.");

        $new = new self();
        $new->rootDir = $this->rootDir;
        $new->curDir = $realPath;
        return $new;
    }


    public function withFileName (string $fileName) : VirtualFile
    {
        $relDir = $this->curDir . "/" . $fileName;
        if ( ! is_file($relDir))
            throw new PathNotFoundException("File $relDir not found.");
        $realPath = realpath($relDir);
        if ($realPath === false)
            throw new PathOutOfBoundsException("Path '$fileName' not resolvable.");
        if (strpos($realPath, $this->rootDir) !== 0)
            throw new PathOutOfBoundsException("Path '$fileName' outside root directory.");
        $new = new VirtualFile();
        $new->rootDir = $this->rootDir;
        $new->curDir = $realPath;
        return $new;
    }


    public static function resolve(string $path) : string
    {
        $parts = explode("/", $path);
        $ret = [];
        foreach ($parts as $part) {
            if ($part == "")
                continue;
            if ($part == "." || $part == "")
                continue;
            if ($part == "..") {
                if (count ($ret) == 0)
                    throw new PathOutOfBoundsException("Path is out of bounds: $path");
                array_pop($ret);
                continue;
            }
            $ret[] = $part;
        }
        return implode("/", $ret);
    }

}