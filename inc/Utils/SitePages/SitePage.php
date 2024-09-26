<?php
namespace YourApp\Utils\SitePages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class SitePage extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_action( 'wp', fn() => $this->on_maybe_is_current() );
  }

  private function on_maybe_is_current() : void
  {
    if ( $this->is_current() )
    {
      $this->on_is_current();
    }
  }

  protected function on_is_current() : void
  {
    $this->enqueue_assets();
  }

  private function enqueue_assets() : void
  {
    $this->enqueue_js();
    $this->enqueue_css();
  }

  abstract public function is_current() : bool;

  abstract protected function enqueue_js() : void;

  abstract protected function enqueue_css() : void;
}