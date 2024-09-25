<?php
namespace YourApp\SiteSetupValidator\Validators;

if (!defined('ABSPATH')) exit;

abstract class Validator extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    $this->validate();
  }

  abstract public function validate() : void;
}