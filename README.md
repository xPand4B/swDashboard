# Shopware Dashboard
A dashboard to manage multiple Shopware installations on your local machine.

- **License**: MIT License
- **Github Repository**: <https://github.com/xPand4B/swDashboard>
- **Issue Tracker**: <https://github.com/xPand4B/swDashboard/issues>

# Table of content
* [How to install](#how-to-install)
    * [Settings](#settings)
    * [Install](#install)
    * [Console Command](#console-command)

## How to install

### Settings
To setup the application with custom configurations you need a file named `.psh.yaml.override` in your **root directory**.
After you have that go inside the `.psh.yaml`, crap all settings you wanna change and paste them inside the `.psh.yaml.override`.

**IMPORTANT:** You need to keep the original hierarchy!

(e.x. you wanna override a const, there has to be a `const:` at the beginning.)

### Install
To install to simply type `./psh.phar` install.


### Console command
All available console commands _(Production and Development)_ can be found by typing `./psh.phar`.
