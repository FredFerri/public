# Toolset Common

A collection of PHP, JavaScript and CSS libraries, utilities and models to be used with Toolset plugins.

## Installation

There's nothing to do for using Toolset Common in production, since it is not a standalone package. It will be already bundled in Toolset plugins, wherever it is needed.

## Development

### As a standalone project

1. Clone the project to your plugins directory.
2. Run `make dev` (or `make setup` if you're doing this for the first time).

Note: Running `make` or `make help` will show more available make targets.

### As a dependency from other plugin

Toolset Common gets included as a Composer dependency on the major Toolset plugins.

You can decide which Toolset Common version gets loaded [with this add-on helper](https://github.com/zaantar/tcl-status).

In this scenario, no further installation is required.

## Basic requirements

- PHP 7.0+
- Git
- make
- Composer
- Node.js

## Autoloader classmap

Whenever you add, remove or move a PHP file with a class, you need to update the classmap by running `make classmap`.

Note that this script requires having a Zend framework available. See inline comments for more information.

## Documentation

[Project Wiki](https://git.onthegosystems.com/toolset/toolset-common/-/wikis/Home).
