# Composer Project Bootstrap Plugin #

## Overview ##

Provides composer functionality to bootstrap projects.


## Installing ##

To install the plugin simply run...

    $ composer global require cubicmushroom/composer-pluing-project-bootstrap dev-develop


## Commands ##

The plugin adds the following commands to composer...


### cm:bootstrap-project ###

Prompts for the directory to install the new project into, runs the composer init script, and then fires as event for 
other plugins to use to extend the bootstrap process 