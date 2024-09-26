<?php
namespace YourApp\SiteSetupValidator;

if (!defined('ABSPATH')) exit;

class SiteSetupValidator extends \YourApp\Utils\DesignPatterns\Singleton
{
  static protected $critical_errors = [];

  static protected $general_errors = [];

  protected function __construct()
  {
    \YourApp\SiteSetupValidator\Validators\WPDebugValidator::get_instance();
    \YourApp\SiteSetupValidator\Validators\WPSettingsValidator::get_instance();
    // todo (step 1): remove this line and corresponding class if you don't use GridPane
    \YourApp\SiteSetupValidator\Validators\GridPaneValidator::get_instance();
    \YourApp\SiteSetupValidator\Validators\DependenciesValidator::get_instance();
  }
}