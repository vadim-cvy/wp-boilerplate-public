# WP Boilerplate by Vadim Cherepenichev

## Installation
1. Search & replace namespace related occurancies:
    * "YourApp"
    * "YOURAPP"
    * "yourapp"
2. Search for "todo" and follow the instructions.
3. Execute `composer install`.
4. Execute `npm install`.
5. Define constants described in "Required PHP Constants" section (bellow). Do this in `wp-config.php` and not inside your plugin/theme to make it possible to set different values in different environments.

## Migration
1. Define constants described in "Required PHP Constants" section (bellow) in `wp-config.php`.

## Required PHP Constants
* `MYAPP_IS_GRIDPANE`: `true` / `false`.
* `MYAPP_ENV`: `"loc"` / `"stg"` / `"prod"`.

## Development
* PHP
    * All includes must be stored at `/inc`.
    * Autoload follows PSR-4 standard. Ex: `\MyApp\DirName\ClassName` = `./inc/DirName/ClassName.php`.
* JS & CSS
    * `npm run dev` watches `./assets/src/` files changes and compiles them into `./assets/dist/`.
    * You MUST keep scss files structure like this:
        * `/assets/src/css/page-home/`
            * `index.scss` (include `foo.scss` and `bar.scss` here)
            * `foo.scss`
            * `bar.scss`
        * `/assets/src/css/post-type-your-post-type-name/`
            * `index.scss` (include `foo.scss` and `bar.scss` here)
            * `foo.scss`
            * `bar.scss`
    * You MUST keep js files structure like this:
        * `/assets/src/js/page-home/`
            * `index.ts` (include `foo.ts` and `bar.ts` here)
            * `foo.ts`
            * `bar.ts`
        * `/assets/src/js/post-type-your-post-type-name/`
            * `index.ts` (include `foo.ts` and `bar.ts` here)
            * `foo.ts`
            * `bar.ts`