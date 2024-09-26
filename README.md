# WP Boilerplate by Vadim Cherepenichev

## Installation
1. Remove all `plugin.*` files from the boilerplate root dir if you're going to create a theme, otherwise remove all `theme.*` files.
2. Remove `plugin.` / `theme.` prefixes from file names in the root dir.
3. Search & replace namespace related occurancies:
    * "YourApp"
    * "YOURAPP"
    * "yourapp"
4. Search for todos in the following order and follow the instructions:
    * "todo (step 1)"
    * "todo (step 2)"
    * "todo (step 3)"
5. Execute `composer install`.
6. Execute `npm install`.
7. Define constants described in "PHP Constants > Constants You MUST Define" section (bellow).

## Migration
1. Define constants described in "PHP Constants > Constants You MUST Define" section (bellow).

## PHP Constants

### Constants You MUST Define

You MUST NOT define constants inside your theme/plugin. Use `wp-config.php` to make it possible to set different constant values for different environments.

* `YOURAPP_ENV`: `"loc"` / `"stg"` / `"prod"`.
* `YOURAPP_DOMAIN_LOC`: local domain (no scheme, just domain).
* `YOURAPP_DOMAIN_STG`: staging domain (no scheme, just domain).
* `YOURAPP_DOMAIN_PROD`: production domain (no scheme, just domain).

### Constants You MUST NOT Redefine
* `YOURAPP_ROOT_DIR`
* `YOURAPP_TEMPLATES_DIR`
* `YOURAPP_ASSETS_DIST_DIR`

## PHP Development

* Store your classes in `./inc/` (autoload is targeted on this dir).
* Follow PSR-4 class/namespace naming standard to make autoload work. Ex:
    * `\YourApp\Foo\ClassName` class must be declared in `./inc/Foo/ClassName.php` file.
    * `\YourApp\Foo\Bar\ClassName` class must be declared in `./inc/Foo/Bar/ClassName.php` file.
    * `\YourApp\Foo\Bar\Baz\ClassName` class must be declared in `./inc/Foo/Bar/Baz/ClassName.php` file.

## JS & CSS Development

* Use `npm run dev` when you work with JS/CSS. It watches source files in `./assets/src/` and compiles them into `./assets/dist/`.
* Keep your files structure like this:
    * `./assets/`
        * `src/`
            * `css/`
                * `page-home/`
                    * `index.scss` (include `foo.scss` and `bar.scss` here)
                    * `foo.scss`
                    * `bar.scss`
                * `post-type-your-post-type-name/`
                    * `index.scss` (include `foo.scss` and `bar.scss` here)
                    * `foo.scss`
                    * `bar.scss`
            * `js/`
                * `page-home/`
                    * `index.ts` (include `foo.ts` and `bar.ts` here)
                    * `foo.ts`
                    * `bar.ts`
                * `post-type-your-post-type-name/`
                    * `index.ts` (include `foo.ts` and `bar.ts` here)
                    * `foo.ts`
                    * `bar.ts`