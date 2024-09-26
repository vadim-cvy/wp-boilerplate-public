<?php
namespace YourApp\Utils\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class PostTypeArchive extends SitePage
{
  abstract public function get_post_type_slug() : string;

  public function is_current() : bool
  {
    return is_post_type_archive( $this->get_post_type_slug() );
  }
}