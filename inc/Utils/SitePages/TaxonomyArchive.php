<?php
namespace YourApp\Utils\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class TaxonomyArchive extends SitePage
{
  abstract public function get_taxonomy_slug() : string;

  public function is_current() : bool
  {
    return is_tax( $this->get_taxonomy_slug() );
  }
}