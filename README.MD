# READ ME #

## Requirements ##
* [Git](https://git-scm.com/)
* [NodeJS with npm](https://nodejs.org/en/)
    * [grunt-cli](http://gruntjs.com/getting-started)
    * [bower](https://bower.io/#install-bower)
* [WP-CLI](https://wp-cli.org/) (optional)

## Checkout ##

Open system console (on Windows you can use Mingw64 which will be installed with git) and run below commands:

1. `php --version`
2. `git --version`
3. `npm --version`
4. `grunt --version`
5. `bower --version`

All of them should display current version of library.

## First run (installation) ##

:warning: **Do not clone project from PhpStorm!**

1. ​:file_folder: Create empty folder in your file system for project. In this case, name of new folder will be `Event Shares - WPX`.
2. Open console in root of `Event Shares - WPX` folder.
3. Clone project from git with submodules (`--recursive` option).
    * `git clone --recursive https://bitbucket.org/wordpressgeekss/2-event-shares-wpx .` ​:warning:​ **Don't omit the last dot.**
4. Pagebox modules and some plugins in project is stored as git submodule, now we must prepare them for work.
    1. `git submodule foreach --recursive git checkout master` - switch all submodules to branch "master".
5. ​Go to Pagebox theme folder `wp-content/themes/event-shares`, this is the special WP theme with some features as bower and grunt. :warning: **This theme is an integral part of Pagebox project.**
    1. `npm install` - install required libraries for grunt and bower.
    2. `bower install -f` - install libraries for theme as jQuery or Slick.
6. Run project on local server and install Wordpress.
    1. Create local domain [http://eventshares.dev](eventshares.dev).
    2. Create local database "eventshares".
    3. For clean installation go to site url and install WP manually or use WP-CLI:
        1. `wp-cli core config --dbname=eventshares --dbuser=root --dbpass=root --dbhost=127.0.0.1`
        2. `wp-cli core install --url=eventshares.dev --title="Event Shares WPX" --admin_user=admin --admin_password=admin --admin_email=admin@eventshares.dev --skip-email`
        3. `wp-cli theme activate event-shares`
        4. `wp-cli plugin activate pagebox pagebox-examples wpg-security`
    4. Add `define('WP_DEBUG', true);` to `wp-config.php` file or copy from `wp-config-sample.php`.
7. Open console in `wp-content/themes/event-shares` folder and run `grunt`. **Always do this before you start.** That's all :smiley: