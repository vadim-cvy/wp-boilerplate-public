<?php
namespace YourApp\Utils\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Front extends SitePage
{
  public function is_current() : bool
  {
    return is_front_page();
  }
}