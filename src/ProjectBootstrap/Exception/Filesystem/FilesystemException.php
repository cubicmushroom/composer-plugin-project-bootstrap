<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Composer\Plugin\ProjectBootstrap\Exception\Filesystem;

use CubicMushroom\Composer\Plugin\ProjectBootstrap\Exception\Exception;

/**
 * Based Filesystem exception class
 *
 * @package CubicMushroom\Composer\Plugin\ProjectBootstrap
 */
class FilesystemException extends Exception
{
    /**
     * @var \SplFileInfo
     */
    protected $path;


    /**
     * @param \SplFileInfo $path
     *
     * @return static
     */
    public static function create(\SplFileInfo $path)
    {
        $e = new static(static::getDefaultMessage($path));

        $e->path = $path;

        return $e;
    }


    /**
     * This method should be overridden in the child classes really, but will work without
     *
     * @param \SplFileInfo $path
     *
     * @throws Exception if child class does not override this class
     */
    protected static function getDefaultMessage(\SplFileInfo $path) {
        return sprintf('%s thrown for file %s', get_called_class(), $path->getPathname());
    }


    /**
     * @return \SplFileInfo
     */
    public function getPath()
    {
        return $this->path;
    }
}