<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilder;

use stdClass;

if ( ! defined( 'ABSPATH' ) ) exit;

class SiteMigrationUrlFixer extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_filter( 'fl_builder_node_settings', fn( $node_settings ) => $this->fix_node_urls( $node_settings ) );
  }

  private function fix_node_urls( stdClass $node_settings ) : stdClass
  {
    foreach ( array_keys( (array) $node_settings ) as $key )
    {
      if ( ! is_string( $node_settings->{$key} ) )
      {
        continue;
      }

      $env_domains = [
        'loc' => YOURAPP_DOMAIN_LOC,
        'stg' => YOURAPP_DOMAIN_STG,
        'prod' => YOURAPP_DOMAIN_PROD,
      ];

      unset( $env_domains[ YOURAPP_ENV ] );

      foreach ( $env_domains as $env_domain )
      {
        $node_settings->{$key} = preg_replace(
          '/https?:\/\/' . $env_domain . '/',
          site_url(),
          $node_settings->{$key}
        );
      }
    }

    return $node_settings;
  }
}
