<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * todo (step 3):
 * Init your custom code here.
 * See "README.md >> PHP Development" before you start.
 */

// todo (step 1): remove this line and corresponding file if you don't have any unique custom code for the home page
\YourApp\SitePages\Front::get_instance();

// todo (step 3): remove or overwrite this example and corresponding file
add_shortcode( 'yourapp_example', fn( $atts, $user_content ) =>
  (new \YourApp\ShortcodeRenderContexts\Example( $atts, $user_content ))->get_content()
);