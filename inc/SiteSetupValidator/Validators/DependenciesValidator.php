<?php
namespace YourApp\SiteSetupValidator\Validators;

use YourApp\Utils\Env\Env;
use YourApp\SiteSetupValidator\Helpers\ErrorsManager;

if (!defined('ABSPATH')) exit;

class DependenciesValidator extends Validator
{
  private const STATUS_INACTIVE = 0;
  private const STATUS_ACTIVE = 1;

  public function validate() : void
  {
    $this->validate_plugin_status__query_monitor();
    $this->validate_plugin_status__mail_logging();
    $this->validate_plugin_status__disable_emails();
  }

  private function validate_plugin_status__query_monitor() : void
  {
    $expected_status = Env::get_instance()->is_prod() ? static::STATUS_INACTIVE : static::STATUS_ACTIVE;
    $is_critical = false;

    $this->validate_plugin( 'Query Monitor', 'query-monitor/query-monitor.php', $expected_status, $is_critical );
  }

  private function validate_plugin_status__mail_logging() : void
  {
    $expected_status = Env::get_instance()->is_prod() ? static::STATUS_INACTIVE : static::STATUS_ACTIVE;
    $is_critical = false;

    $this->validate_plugin( 'WP Mail Logging', 'wp-mail-logging/wp-mail-logging.php', $expected_status, $is_critical );
  }

  private function validate_plugin_status__disable_emails() : void
  {
    $expected_status = Env::get_instance()->is_prod() ? static::STATUS_INACTIVE : static::STATUS_ACTIVE;
    $is_critical = true;

    $this->validate_plugin( 'Disable Emails', 'disable-emails/disable-emails.php', $expected_status, $is_critical );
  }

  private function validate_plugin(
    string $name,
    string $file_rel_path,
    int $expected_status,
    bool $is_critical
  ) : void
  {
    $status = $this->is_plugin_active( $file_rel_path ) ? static::STATUS_ACTIVE : static::STATUS_INACTIVE;

    if ( $status === $expected_status )
    {
      return;
    }

    if ( $expected_status === static::STATUS_ACTIVE )
    {
      $required_action =
        $this->is_plugin_installed( $file_rel_path )
        ? 'activated'
        : 'installed and activated';
    }
    else
    {
      $required_action = 'deactivated';
    }

    $err_msg = sprintf( '%s must be <a href="%s">%s</a>!',
      $name,
      $this->get_plugin_search_url( $file_rel_path ),
      $required_action
    );

    ErrorsManager::get_instance()->add_error( $err_msg, $is_critical );
  }

  private function get_plugin_search_url( string $file_rel_path ) : string
  {
    $file_name = explode( '/', $file_rel_path )[1];
    $slug = str_replace( '.php', '', $file_name );

    $is_installed = $this->is_plugin_installed( $file_rel_path );

    $url = get_admin_url( null, $is_installed ? 'plugins.php' : 'plugin-install.php' );

    $url_params = [
      's' => $slug,
    ];

    if ( $is_installed )
    {
      $url_params['tab'] = 'search';
    }
    else
    {
      $url_params['plugin_status'] = 'inactive';
    }

    return add_query_arg( $url_params, $url );
  }

  private function is_plugin_active( string $file_rel_path ) : bool
  {
    if ( ! function_exists( 'is_plugin_active' ) )
    {
      require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    return is_plugin_active( $file_rel_path );
  }

  private function is_plugin_installed( string $file_rel_path ) : bool
  {
    return file_exists( WP_PLUGIN_DIR . '/' . $file_rel_path );
  }
}