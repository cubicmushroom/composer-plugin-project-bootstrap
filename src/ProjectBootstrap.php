<?php
/**
 * Author: Toby Griffiths
 * Created: 15/05/2016
 */

namespace CubicMushroom\Composer\Plugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Main plugin class
 *
 * @package CubicMushroom\Composer\Plugin\ProjectBootstrap
 */
class ProjectBootstrap implements PluginInterface
{
    /**
     * Apply plugin modifications to Composer
     *
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        // Do nothing here (yet?)
    }
}