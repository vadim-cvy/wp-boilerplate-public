<?php
namespace YourApp\ThirdpartyPlugins\AI1M;

if ( ! defined( 'ABSPATH' ) ) exit;

class AI1M extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    SettingsPreset::get_instance();
  }
}