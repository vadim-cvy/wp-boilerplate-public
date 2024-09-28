<?php
namespace YourApp\Utils\Shortcodes;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class RenderContext
{
  private array $atts;

  private string $user_content;

  private string $error_msg = '';

  public function __construct( string|array $atts, string $user_content )
  {
    $this->set_atts( $atts );

    $this->user_content = $user_content ?? '';
  }

  public function get_content() : string
  {
    ob_start();

    $this->render();

    $content = ob_get_contents();

    ob_end_clean();

    return $content;
  }

  private function set_atts( string|array $atts ) : void
  {
    $this->atts = is_array( $atts ) ? $atts : [];

    $this->validate_atts();
  }

  final protected function get_atts() : array
  {
    return $this->atts;
  }

  private function validate_atts() : void
  {
    try
    {
      $this->validate_requride_atts();
      $this->validate_unexpected_atts();
      $this->validate_att_values();
    }
    catch ( RenderContextError $e )
    {
      $this->error_msg = $e->getMessage();

      trigger_error( $this->error_msg, E_USER_NOTICE );
    }
  }

  private function validate_requride_atts() : void
  {
    $required_atts = $this->get_required_att_names();

    $missing_atts = array_diff( $required_atts, array_keys( $this->atts ) );

    if ( ! empty( $missing_atts ) )
    {
      throw new RenderContextError(sprintf(
        'The following atts are missing: "%s"',
        implode( '", "', $missing_atts )
      ));
    }
  }

  private function validate_unexpected_atts() : void
  {
    $expected_atts = $this->get_expected_att_names();

    $unexpected_atts = array_diff( array_keys( $this->atts ), $expected_atts );

    if ( ! empty( $unexpected_atts ) )
    {
      throw new RenderContextError(sprintf(
        'Unexpected attributes passed: "%s". Expected atts are: "%s".',
        implode( '", "', $unexpected_atts ),
        implode( '", "', $expected_atts )
      ));
    }
  }

  private function validate_att_values() : void
  {
    foreach ( $this->atts as $name => $value )
    {
      $err_msg = $this->get_att_validation_err_msg( $name, $value );

      if ( ! empty( $err_msg ) )
      {
        throw new RenderContextError(sprintf(
          'Attribute validation error!'
            . ' Attribute name: "%s".'
            . ' Attribute value: "%s".'
            . ' Error message: "%s".',
          $name,
          json_encode( $value ),
          $err_msg
        ));
      }
    }
  }

  abstract protected function get_att_validation_err_msg( string $name, mixed $value ) : string;

  protected function get_user_content() : string
  {
    return $this->user_content;
  }

  private function render() : void
  {
    if ( $this->error_msg )
    {
      $this->render_error();
      return;
    }

    $template_args = $this->get_template_args();

    require YOURAPP_TEMPLATES_DIR . $this->get_template_rel_path();
  }

  private function render_error() : void
  {
    $err_msg = 'Error. Can\'t render this content.';

    if ( $this->can_current_user_see_error_details() )
    {
      $err_msg .= ' ' . $this->error_msg;
    }

    echo '<b>' . esc_html( $err_msg ) . '</b>';
  }

  abstract protected function get_template_args() : array;

  abstract protected function get_template_rel_path() : string;

  abstract protected function get_expected_att_names() : array;

  abstract protected function get_required_att_names() : array;

  protected function can_current_user_see_error_details() : bool
  {
    return current_user_can( 'manage_options' );
  }
}