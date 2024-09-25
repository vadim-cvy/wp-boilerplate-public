<?php
namespace YourApp\SiteSetupValidator\Validators;

use YourApp\Utils\Env\Env;
use YourApp\SiteSetupValidator\Helpers\Constants;

if (!defined('ABSPATH')) exit;

class GridPaneValidator extends Validator
{
  public function validate() : void
  {
    if ( Env::get_instance()->is_loc() )
    {
      return;
    }

    $this->validate_const__debug_log();
  }

  private function validate_const__debug_log() : void
  {
    $expected_val = realpath( ABSPATH . '/../logs' ) . '/debug.log';

    Constants::validate_general( 'WP_DEBUG_LOG', fn( $val ) =>
      $val !== $expected_val
      ? sprintf( 'Expected: "%s".', $expected_val )
      : ''
    );
  }
}