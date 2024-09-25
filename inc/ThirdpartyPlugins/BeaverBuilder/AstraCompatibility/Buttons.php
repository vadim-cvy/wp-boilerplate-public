<?php
namespace YourApp\ThirdpartyPlugins\BeaverBuilder\AstraCompatibility;

if (!defined('ABSPATH')) exit;

class Buttons extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_filter( 'fl_builder_render_css', fn( $css ) => $this->strip_bb_buttons_css( $css ) );

    // todo (boilerplate development): it's better to use node_settings hook
    add_filter( 'fl_builder_render_module_content',
      fn( $module_html ) => $this->add_bb_buttons_astra_class( $module_html ) );
  }

  private function strip_bb_buttons_css( string $bb_css ) : string
  {
    $rules_to_remove_selector_patterns = [
      '\.fl-builder-content a\.fl-button,'
        . '\s*'
        . '\.fl-builder-content a\.fl-button:visited',

      '\.fl-builder-content \.fl-button:active',

      '\.fl-builder-content a\.fl-button \*,'
        . '\s*'
        . '\.fl-builder-content a\.fl-button:visited \*',
    ];

    foreach ( $rules_to_remove_selector_patterns as $rule_to_remove_selector_pattern )
    {
      $rule_to_remove_body_pattern = '{[^}]+}';

      $rule_to_remove_pattern =
        '\s*'
        . $rule_to_remove_selector_pattern
        . '\s*'
        . $rule_to_remove_body_pattern
        . '\s*';

      $prev_rule_or_comment_last_sign_pattern = '[}/]';

      $bb_css = preg_replace( "~($prev_rule_or_comment_last_sign_pattern)$rule_to_remove_pattern~", '$1', $bb_css );
    }

    return $bb_css;
  }

  private function add_bb_buttons_astra_class( string $bb_module_html ) : string
  {
    return preg_replace( '~(["\s]fl-button)(["\s])~', '$1 ast-button$2', $bb_module_html );
  }
}