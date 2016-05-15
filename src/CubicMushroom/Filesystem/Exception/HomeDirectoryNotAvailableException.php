<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Filesystem\Exception;

/**
 * Thrown when the user's home directory ($HOME) is not available
 *
 * @package CubicMushroom\Filesystem
 */
class HomeDirectoryNotAvailableException extends Exception
{
    /**
     * HomeDirectoryNotAvailableException constructor.
     *
     * @param string    $message
     * @param int       $code
     * @param \Exception $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        if (empty($message)) {
            $message = 'Unable to determine the user\'s home directory';
        }

        parent::__construct($message, $code, $previous);
    }
}