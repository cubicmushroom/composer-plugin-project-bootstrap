<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Filesystem\Exception;

/**
 * Thrown when a path might be problematic
 *
 * @package CubicMushroom\Filesystem
 */
class ProblematicPathException extends Exception
{
    /**
     * @var string
     */
    protected $path;


    /**
     * @param string          $path
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     *
     * @return ProblematicPathException
     */
    public static function create($path, $message = "", $code = 0, \Exception $previous = null)
    {
        if (empty($message)) {
            $message = "It looks like there might be a problem with your path ({$path})";
        }

        $e = new static($message, $code, $previous);

        $e->path = $path;

        return $e;
    }


    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}