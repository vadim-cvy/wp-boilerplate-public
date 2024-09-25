<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilderThemer;

if ( ! defined( 'ABSPATH' ) ) exit;

class BeaverBuilderThemer extends \YourApp\Utils\DesignPatterns\Singleton
{
  public function __construct()
  {
    PageConnections::get_instance();
  }
}