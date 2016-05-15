<?php
/**
 * Author: Toby Griffiths <toby@cubicmushroom.co.uk>
 * Created: 15/05/2016
 */

namespace CubicMushroom\Composer\Plugin\ProjectBootstrap;

use Composer\Command\BaseCommand;
use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use CubicMushroom\Composer\Plugin\ProjectBootstrap\Command\BootstrapCommand;

/**
 * Registered additional composer commands
 *
 * @package CubicMushroom\Composer\Plugin\ProjectBootstrap
 */
class CommandProvider implements CommandProviderCapability
{

    /**
     * Retreives an array of commands
     *
     * @return BaseCommand[]
     */
    public function getCommands()
    {
        return [new BootstrapCommand()];
    }
}