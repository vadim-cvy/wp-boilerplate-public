# WP Boilerplate by Vadim Cherepenichev

Table of Contents:
* [Installation](#installation)
* [Migration](#migration)
* [PHP Development](#php-development)
    * [Constants You MUST Define in `wp-config.php`](#constants-you-must-define-in-wp-configphp)
    * [Autoloader](#autoloader)
    * [Where to Write Custom Code](#where-to-write-custom-code)
    * [Tips](#tips)
* [JS & CSS Development](#js--css-development)
    * [File Structure](#file-structure)
    * [Watch Changes](#watch-changes)

## Installation
1. Remove all `plugin.*` files from the boilerplate root dir if you're going to create a theme, otherwise remove all `theme.*` files.
2. Remove `plugin.` / `theme.` prefixes from file names in the root dir.
3. Search & replace namespace related occurancies. USE CASE-SENSITIVE SEARCH!
    * "YourApp"
    * "YOURAPP"
    * "yourapp"
4. Search for todos in the following order and follow the instructions:
    * "todo (step 1)"
    * "todo (step 2)"
    * "todo (step 3)"
5. Execute `composer install`.
6. Execute `npm install`.
7. Define constants described in [this](#constants-you-must-define-in-wp-configphp) section.
8. Remove this section from this README file. As well as remove it from the table of contents (above).

## Migration
1. Define PHP constants described in [this](#constants-you-must-define-in-wp-configphp) section.

## PHP Development

### Constants You MUST Define in `wp-config.php`

* `YOURAPP_ENV`: `"loc"` / `"stg"` / `"prod"`.
* `YOURAPP_DOMAIN_LOC`: local domain (no scheme, just domain).
* `YOURAPP_DOMAIN_STG`: staging domain (no scheme, just domain).
* `YOURAPP_DOMAIN_PROD`: production domain (no scheme, just domain).

### Tips
* Boilerplate defines some constants for own needs. You can use them in your code:
    * `YOURAPP_ROOT_DIR`
    * `YOURAPP_TEMPLATES_DIR`
    * `YOURAPP_ASSETS_DIST_DIR`
* Take a look at [`inc/Utils/`](inc/Utils/) to find useful classes which may help you to solve common WP problems.

## JS & CSS Development

### File Structure

Keep your file structure like this:

* [`assets/src`](assets/src/)
    * [`css/`](assets/src/css/)
        * `page-home/`
            * `index.scss` (include `foo.scss` and `bar.scss` here)
            * `foo.scss`
            * `bar.scss`
        * `post-type-your-post-type-name/`
            * `index.scss` (include `foo.scss` and `bar.scss` here)
            * `foo.scss`
            * `bar.scss`
    * [`js/`](assets/src/js/)
        * `page-home/`
            * `index.ts` (include `foo.ts` and `bar.ts` here)
            * `foo.ts`
            * `bar.ts`
        * `post-type-your-post-type-name/`
            * `index.ts` (include `foo.ts` and `bar.ts` here)
            * `foo.ts`
            * `bar.ts`

### Watch Changes

Use `npm run dev` to watch changes in source files from [`assets/src/`](assets/src/) and compiles them into [`assets/dist/`](assets/dist/).