<?php
/**
 * Author: Toby Griffiths
 * Created: 15/05/2016
 */

namespace CubicMushroom\Composer\Plugin\ProjectBootstrap;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider as ComposerCommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;
use CubicMushroom\Composer\Plugin\ProjectBootstrap\CommandProvider as ProjectBootstrapCommandProvider;

/**
 * Main plugin class
 *
 * @package CubicMushroom\Composer\Plugin\ProjectBootstrap
 */
class ProjectBootstrapPlugin implements PluginInterface, Capable
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


    /**
     * Method by which a Plugin announces its API implementations, through an array
     * with a special structure.
     *
     * The key must be a string, representing a fully qualified class/interface name
     * which Composer Plugin API exposes.
     * The value must be a string as well, representing the fully qualified class name
     * of the implementing class.
     *
     * @tutorial
     *
     * return array(
     *     'Composer\Plugin\Capability\CommandProvider' => 'My\CommandProvider',
     *     'Composer\Plugin\Capability\Validator'       => 'My\Validator',
     * );
     *
     * @return string[]
     */
    public function getCapabilities()
    {
        return [
            ComposerCommandProvider::class => ProjectBootstrapCommandProvider::class,
        ];
    }
}