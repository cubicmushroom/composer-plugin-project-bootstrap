<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Filesystem;

use CubicMushroom\Filesystem\Exception\HomeDirectoryNotAvailableException;
use CubicMushroom\Filesystem\Exception\ProblematicPathException;

/**
 * Extension of the PHP base \SplFileInfo class
 *
 * @package CubicMushroom\Filesystem
 */
class SplFileInfo extends \SplFileInfo
{
    /**
     * Resolves the path by removing '..' and '.' notation & converting '~' to the user's home directory, if available
     *
     * @param bool $ignoreWarnings If set to true, will not warn when problems detected
     *
     * @return string
     * 
     * @throws ProblematicPathException if a '~' is detected in the path
     */
    public function resolvePath($ignoreWarnings = false)
    {
        $path = $this->getPathname();

        // Strip '..'s
        $path = preg_replace('#/[^/]+/..(/|$)#', '', $path);

        // Strip '.'s
        $path = preg_replace('#/.(/|$)#', '', $path);

        // Resolve '~'
        $path = preg_replace_callback(
            '#^~#',
            function () {
                $home = getenv('HOME');
                if (false === $home) {
                    throw new HomeDirectoryNotAvailableException();
                }

                return $home;
            },
            $path
        );

        // Warn against '~' directories?
        if (!$ignoreWarnings && preg_match('#/~(/|$)#', $path)) {
            throw ProblematicPathException::create($path, 'Path contains a \'~\' and might cause a problem');
        }

        return $path;
    }
}