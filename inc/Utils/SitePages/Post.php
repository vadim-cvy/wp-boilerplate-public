<?php
namespace YourApp\Utils\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Post extends SitePage
{
  abstract public function get_post_id() : int;

  public function is_current() : bool
  {
    return is_singular( $this->get_post_id() ) || is_page( $this->get_post_id() );
  }
}