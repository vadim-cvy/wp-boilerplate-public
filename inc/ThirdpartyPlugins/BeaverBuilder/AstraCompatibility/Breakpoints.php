<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilder\AstraCompatibility;

use FLBuilderModel;

if (!defined('ABSPATH')) exit;

class Breakpoints extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_filter( 'astra_tablet_breakpoint', fn() => FLBuilderModel::get_global_settings()->medium_breakpoint );
    add_filter( 'astra_mobile_breakpoint', fn() => FLBuilderModel::get_global_settings()->responsive_breakpoint );
  }
}