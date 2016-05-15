<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Symfony\ConsoleExtras\Helper;

use Symfony\Component\Console\Helper\Helper;

/**
 * Helper for file system interaction
 *
 * @package CubicMushroom\Symfony\ConsoleExtras
 */
class FileSystemHelper extends Helper
{
    const NAME = 'filesystem';


    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return self::NAME;
    }
}