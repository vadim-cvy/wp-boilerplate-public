<?php
namespace YourApp\SiteSetupValidator\Validators;

use YourApp\Utils\Env\Env;
use YourApp\SiteSetupValidator\Helpers\Constants;

if (!defined('ABSPATH')) exit;

class WPDebugValidator extends Validator
{
  public function validate() : void
  {
    $this->validate_const__debug_display();
    $this->validate_const__debug_log();
    $this->validate_const__debug();
  }

  private function validate_const__debug_display() : void
  {
    $expected_val = Env::get_instance()->is_loc();

    Constants::validate_critical( 'WP_DEBUG_DISPLAY', fn( $val ) =>
      $val !== $expected_val
      ? sprintf( 'Expected: "%s".', json_encode( $expected_val ) )
      : ''
    );
  }

  private function validate_const__debug_log() : void
  {
    Constants::validate_general( 'WP_DEBUG_LOG', fn( $val ) =>
      ! $val ? 'Expected: "true" or a string presenting custom log file path.' : '' );
  }

  private function validate_const__debug() : void
  {
    Constants::validate_general( 'WP_DEBUG', fn( $val ) =>
      ! $val ? 'Expected: "true".' : '' );
  }
}