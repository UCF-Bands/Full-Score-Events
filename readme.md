# Features

* PHP namespacing
* PSR-4 autoloading via composer!
* CPT registration class with "Sample" CPT
* PHPCS with WordPress coding standards integration through command line and/or code editor (VS Code workspace settings included)

# Getting Started

## Clone

Clone this repo down to your `wp-content/plugins` folder and **delete the `.git`
folder inside it so you're editing a new plugin instead of this repository**.

## Local setup

1. Install NPM dependencies: `npm install`
1. Install untracked composer dependencies: `composer install`
1. Make sure the autoloader has the right namespace: `composer dump-autoload`
1. Install PHPCS languages: `composer run-script install-codestandards`
1. Configure PHPCS linting in your editor so you don't have to rely only on the `phpcs` composer script

## VS Code

To get PHP code linting, install the [phpcs extension](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs). You may already have this for `wprig`-based development. After that, `./vscode/settings.json` should automatically get VS Code linting your PHP files, checking them with WordPress coding standards. You may need to restart VS Code for this to work properly, especially if you had to change a configuration setting or activate a new extension.

For JavaScript code linting, install the [ESLint extension](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint). It should see the rules configured by `.eslintrc`'s and lint your JS.

## Other Editors

PHP_CodeSniffer (PHPCS) and ESLint are extremely common utlities that should have compatibility or extensions for all the major editors. As long as the instructions are there (`.eslintrc`, `.eslintignore`, `phpcs.xml.dist`, etc), any major editor should be able to do inline code linting.

## Building

1. Build your plugin functionality
1. Run `composer run-script phpcs` to make sure your PHP code is up to WordPress standards. This is expecially important if you don't have linting built in to your editor.
