<?php
namespace YourApp\Utils\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class PostTypePost extends SitePage
{
  abstract public function get_post_type_slug() : string;

  public function is_current() : bool
  {
    return is_singular( $this->get_post_type_slug() );
  }
}