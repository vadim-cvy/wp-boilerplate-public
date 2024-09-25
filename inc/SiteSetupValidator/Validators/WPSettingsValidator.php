<?php
namespace YourApp\SiteSetupValidator\Validators;

use YourApp\Utils\Env\Env;
use YourApp\SiteSetupValidator\Helpers\ErrorsManager;

if (!defined('ABSPATH')) exit;

class WPSettingsValidator extends Validator
{
  public function validate() : void
  {
    $this->validate_search_engine_visibility();
  }

  private function validate_search_engine_visibility() : void
  {
    $is_enabled = get_option( 'blog_public' );

    if ( Env::get_instance()->is_prod() && ! $is_enabled )
    {
      $required_action_label = 'enabled';
    }
    else if ( ! Env::get_instance()->is_prod() && $is_enabled )
    {
      $required_action_label = 'disabled';
    }
    else
    {
      return;
    }

    ErrorsManager::get_instance()->add_error(sprintf(
      'Search engine visibility must be <a href="%s">%s</a>!',
      get_admin_url( null, 'options-reading.php' ),
      $required_action_label
    ), true );
  }
}