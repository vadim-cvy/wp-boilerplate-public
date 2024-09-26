<?php
namespace YourApp\SitePages;

use YourApp\Utils\Assets\Assets;

if ( ! defined( 'ABSPATH' ) ) exit;

class Front extends \YourApp\Utils\SitePages\Front
{
  // todo: remove this method if not needed
  protected function on_is_current() : void
  {
    parent::on_is_current();

    // Your code here
  }

  protected function enqueue_js() : void
  {
    // todo: remove this line and corresponding js src and dist files if not needed
    Assets::enqueue_local_js( 'page-front' );
  }

  protected function enqueue_css() : void
  {
    // todo: remove this line and corresponding css src and dist files if not needed
    Assets::enqueue_local_css( 'page-front' );
  }
}