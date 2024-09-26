<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'YOURAPP_ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR );
define( 'YOURAPP_TEMPLATES_DIR', YOURAPP_ROOT_DIR . 'template-parts' . DIRECTORY_SEPARATOR );
define( 'YOURAPP_ASSETS_DIST_DIR', YOURAPP_ROOT_DIR . 'assets/dist' . DIRECTORY_SEPARATOR );

require_once __DIR__ . '/vendor/autoload.php';

YourApp\SiteSetupValidator\SiteSetupValidator::get_instance();

// todo (step 1): remove this line and corresponding dir if you don't use All-in-One WP Migration
YourApp\ThirdpartyPlugins\AI1M\AI1M::get_instance();

// todo (step 1): remove this line and corresponding dir if you don't use Beaver Builder
YourApp\ThirdpartyPlugins\BeaverBuilder\BeaverBuilder::get_instance();

// todo (step 1): remove this line and corresponding dir if you don't use Beaver Builder Themer
YourApp\ThirdpartyPlugins\BeaverBuilderThemer\BeaverBuilderThemer::get_instance();