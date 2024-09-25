<?php
namespace YourApp\Utils\DesignPatterns;

if (!defined('ABSPATH')) exit;

use Exception;

class Singleton
{
  static protected $instances = [];

  static public function get_instance()
  {
    $key = get_called_class();

    if ( empty( static::$instances[ $key ] ) )
    {
      static::$instances[ $key ] = new static();
    }

    return static::$instances[ $key ];
  }

  protected function __construct()
  {
    throw new Exception( 'This method is abstract and must be implemented therefore!' );
  }
}