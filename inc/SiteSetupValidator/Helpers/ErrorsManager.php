<?php
namespace YourApp\SiteSetupValidator\Helpers;

use YourApp\Utils\Assets\Assets;

if (!defined('ABSPATH')) exit;

class ErrorsManager extends \YourApp\Utils\DesignPatterns\Singleton
{
  private array $critical_errors = [];
  private array $general_errors = [];

  protected function __construct()
  {
    add_action( 'wp', fn() => $this->enqueue_assets() );
    add_action( 'admin_init', fn() => $this->enqueue_assets() );
  }

  public function add_error( string $msg, bool $is_critical ) : void
  {
    trigger_error( $msg, $is_critical ? E_USER_WARNING : E_USER_NOTICE );

    if ( $is_critical )
    {
      if ( ! $this->is_user_authorized_see_errors() )
      {
        $this->die('');
      }
      else if ( ! is_admin() )
      {
        $this->die( $msg );
      }
    }

    if ( $this->is_user_authorized_see_errors() )
    {
      if ( $is_critical )
      {
        $this->critical_errors[] = $msg;
      }
      else
      {
        $this->general_errors[] = $msg;
      }
    }
  }

  private function enqueue_assets() : void
  {
    if (
      ( empty( $this->critical_errors ) && empty( $this->general_errors ) )
      || ! $this->is_user_authorized_see_errors()
    )
    {
      return;
    }

    Assets::enqueue_local_js( 'site-setup-validator', [], [
      'errors' => [
        'critical' => $this->critical_errors,
        'general' => $this->general_errors,
      ],
      'env' => YOURAPP_ENV,
    ]);
  }

  public function is_user_authorized_see_errors() : bool
  {
    return current_user_can( 'administrator' );
  }

  public function die( string $msg = '' ) : void
  {
    if ( $this->is_user_authorized_see_errors() )
    {
      $title = 'Setup Error';

      $msg = 'Site setup error: ' . $msg;
    }
    else
    {
      $title = 'Scheduled maintenance';

      $msg = 'We\'re currently undergoing scheduled maintenance. Please come back in 10 minutes. Thank you for your patience!';
    }

    wp_die( $msg, $title );
  }
}