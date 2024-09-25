<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilder;

use \YourApp\ThirdpartyPlugins\BeaverBuilder\AstraCompatibility\AstraCompatibility;

if ( ! defined( 'ABSPATH' ) ) exit;

class BeaverBuilder extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    // todo: remove this line and corresponding dir if you don't use Astra theme
    AstraCompatibility::get_instance();

    SiteMigrationURLFixer::get_instance();
  }
}
