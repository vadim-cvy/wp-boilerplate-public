<?php
namespace YourApp\SiteSetupValidator\Helpers;

use YourApp\SiteSetupValidator\Helpers\ErrorsManager;

if (!defined('ABSPATH')) exit;

class Constants
{
  static public function validate_general( string $const_name, callable $get_val_error_msg_cb = null ) : void
  {
    static::validate( $const_name, false, $get_val_error_msg_cb );
  }

  static public function validate_critical( string $const_name, callable $get_val_error_msg_cb = null ) : void
  {
    static::validate( $const_name, true, $get_val_error_msg_cb );
  }

  static private function validate( string $const_name, bool $is_critical, callable $get_val_error_msg_cb = null ) : void
  {
    $error_msg = static::get_error_msg( $const_name, $get_val_error_msg_cb );

    if ( $error_msg )
    {
      ErrorsManager::get_instance()->add_error( $error_msg, $is_critical );
    }
  }

  static private function get_error_msg( string $const_name, callable $get_val_error_msg_cb = null ) : string
  {
    if ( ! defined( $const_name ) )
    {
      return "$const_name MUST be defined!";
    }

    if ( ! $get_val_error_msg_cb )
    {
      return '';
    }

    $value = constant( $const_name );

    $error_msg = $get_val_error_msg_cb( $value );

    if ( ! $error_msg )
    {
      return '';
    }

    return sprintf(
      'Unexpected value of %s constant!'
        . ' <br>Passed value: "%s".'
        . ' <br>%s',
      $const_name,
      json_encode( $value ),
      $error_msg
    );
  }
}