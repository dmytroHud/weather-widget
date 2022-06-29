<?php
/**
 * Plugin Name: Weather Widget
 * Description: Plugin Description
 * Version:     1.0.0
 * Author:      Dmytro Hudenko
 */

namespace WeatherWidget;
use WeatherWidget\classes\PluginSettings;
use WeatherWidget\classes\WeatherShortcode;

if ( ! defined( 'ABSPATH' ) ) exit;


final class App {

	const TEXT_DOMAIN = 'weather-widget';
	const PLUGIN_VERSION = '1.0.0';
	const PLUGIN_DIR = __DIR__;
	public static $pluginURL = null;

	public function __construct() {
		self::$pluginURL = plugin_dir_url(__FILE__);

		add_action('init', function () {
			WeatherShortcode::init();
			PluginSettings::init();
		});

		add_action('wp_enqueue_scripts', [__CLASS__, 'registerAssets']);
	}

	public static function registerAssets() {
		wp_register_style('ww-styles', self::$pluginURL . 'assets/css/styles.css', '',self::PLUGIN_VERSION);

		wp_enqueue_script('jquery');
		wp_register_script('ww-scripts', self::$pluginURL . 'assets/js/script.js', ['jquery'], self::PLUGIN_VERSION);
	}

}

require_once 'helpers/ViewsLoader.php';
require_once 'classes/WeatherShortcode.php';
require_once 'classes/PluginSettings.php';
new App();

