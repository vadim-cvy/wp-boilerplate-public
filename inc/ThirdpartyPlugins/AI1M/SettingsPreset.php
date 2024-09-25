<?php
namespace YourApp\ThirdpartyPlugins\AI1M;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPreset extends \YourApp\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    $this->preset_export_file_exclusions();

    add_action( 'admin_print_footer_scripts', fn() => $this->preset_export_checkboxes() );
  }

  private function preset_export_checkboxes() : void
  {
    echo <<<EOF
      <script>
        jQuery( '#ai1wm-export-form .ai1wm-accordion' ).addClass( 'ai1wm-open' )

        jQuery(
          `#ai1wm-no-spam-comments,
          #ai1wm-no-post-revisions,
          #ai1wm-no-inactive-themes,
          #ai1wm-no-inactive-plugins,
          #ai1wm-no-cache`
        )
        .prop( 'checked', true )
        .trigger( 'change' );
      </script>
      EOF;
  }

  private function preset_export_file_exclusions() : void
  {
    $theme_dir = basename( get_stylesheet_directory() );

    $custom_excludes = array_map( fn( $file_name ) => "$theme_dir/$file_name", [
      '.vscode',
      '.git',
      '.gitignore',
      'composer.json',
      'composer.lock',
      'package.json',
      'package.lock',
      'gulpfile.js',
      'tsconfig.json',
      'webpack.config.js',
      'README.md',
      'node_modules',
      'assets/src',
    ]);

    add_filter( 'ai1wm_exclude_themes_from_export', fn( $excludes ) => array_merge( $excludes, $custom_excludes ) );
  }
}