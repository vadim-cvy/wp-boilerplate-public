<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilderThemer;

use FLPageData;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class PageConnections extends \YourApp\Utils\DesignPatterns\Singleton
{
  public function __construct()
  {
    add_action( 'init', fn() => $this->register() );
  }

  private function register() : void
  {
    $this->register_pages_url_group();
    $this->register_pages_url_connections();
  }

  private function get_page_urls_group_key() : string
  {
    return 'yourapp_page_urls';
  }

  private function register_pages_url_group() : void
  {
    FLPageData::add_group( $this->get_page_urls_group_key(), array(
      'label' => 'YourApp Page URLs',
      'connections' => array_unique( array_column( $this->get_pages_url_connections_data(), 'type' ) ),
    ));
  }

  private function register_pages_url_connections() : void
  {
    foreach ( $this->get_pages_url_connections_data() as $key => $data )
    {
      $data['group'] = $this->get_page_urls_group_key();

      FLPageData::add_post_property( $key, $data );
    }
  }

  private function get_pages_url_connections_data() : array
  {
    $page_ids = (new WP_Query([
      'post_type' => 'page',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'fields' => 'ids',
      'orderby' => 'title',
      'order' => 'ASC',
    ]))->posts;

    return array_map(fn( $page_id ) => [
      'type' => 'url',
      'label' => get_the_title( $page_id ),
      'getter' => fn() => get_permalink( $page_id ),
    ], $page_ids );
  }
}