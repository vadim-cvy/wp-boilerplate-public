<?php
namespace YourApp\Utils\Env;

use Exception;

if ( ! defined( 'ABSPATH' ) ) exit;

class Env extends \YourApp\Utils\DesignPatterns\Singleton
{
  private $ENV_PROD = 'prod';
  private $ENV_STG = 'stg';
  private $ENV_LOC = 'loc';

  private $env;

  public function __construct()
  {
    $this->set_env();
  }

  private function set_env()
  {
    if ( ! defined( 'YOURAPP_ENV' ) )
    {
      throw new Exception( 'YOURAPP_ENV is not defined' );
    }

    $expected_values = [ $this->ENV_PROD, $this->ENV_STG, $this->ENV_LOC ];

    if ( ! in_array( YOURAPP_ENV, $expected_values ) )
    {
      throw new Exception(sprintf(
        'YOURAPP_ENV constant value is not valid! Expected: "%s". Passed: "%s".',
        implode( '", "', $expected_values ),
        json_encode( YOURAPP_ENV )
      ));
    }

    $this->env = YOURAPP_ENV;
  }

  public function is_prod() : bool
  {
    return $this->env === $this->ENV_PROD;
  }

  public function is_stg() : bool
  {
    return $this->env === $this->ENV_STG;
  }

  public function is_loc() : bool
  {
    return $this->env === $this->ENV_LOC;
  }
}