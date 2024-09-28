<?php
namespace YourApp\Utils\Env;

if ( ! defined( 'ABSPATH' ) ) exit;

class Example extends \YourApp\Utils\Shortcodes\RenderContext
{
  protected function get_att_validation_err_msg( string $name, mixed $value ) : string
  {
    if ( $name === 'foo' && ! is_string( $value ) )
    {
      return 'The value must be a string.';
    }

    return '';
  }

  protected function get_template_args() : array
  {
    $foo = $this->get_atts()['foo'];
    $bar = $this->get_atts()['bar'] ?? '---';

    return [
      'foo' => $foo,
      'bar' => $bar,
      'baz' => $foo . $bar . 'baz',
    ];
  }

  protected function get_template_rel_path() : string
  {
    return 'shortcodes/example.php';
  }

  protected function get_expected_att_names() : array
  {
    return [
      'foo',
      'bar',
    ];
  }

  protected function get_required_att_names() : array
  {
    return [
      'foo',
    ];
  }
}