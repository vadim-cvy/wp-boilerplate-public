<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilder\AstraCompatibility;

if (!defined('ABSPATH')) exit;

class AstraCompatibility extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    Breakpoints::get_instance();
    Buttons::get_instance();
  }
}