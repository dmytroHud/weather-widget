<?php

namespace WeatherWidget\classes;

use WeatherWidget\helpers\ViewsLoader;

class WeatherShortcode {

	const SHORTCODE = 'ww-weather';

	protected static $LocalizeScriptData = [];

	public static function init() {
		add_shortcode(self::SHORTCODE, [__CLASS__, 'shortcode']);
		add_action('wp_ajax_ww_show_weather', [__CLASS__, 'showWeather']);
		add_action('wp_ajax_nopriv_ww_show_weather', [__CLASS__, 'showWeather']);
		add_action('wp_footer', [__CLASS__, 'loadAssets']);
	}

	public static function shortcode($atts) {
		$atts = shortcode_atts( [
			'title' => '',
			'units'  => '',
			'wind'  => 1
		], $atts, self::SHORTCODE );

		$widget_id = bin2hex(random_bytes(10));

		static::$LocalizeScriptData[] = [
			'id' =>  $widget_id,
			'atts' => $atts
		];

		return sprintf('<div class="ww-container" id="%s"></div>', $widget_id);
	}

	public static function showWeather() {
		if(!isset($_POST['atts']) || !isset($_POST['place']) || !isset($_POST['temp']) || !isset($_POST['wind']) || !isset($_POST['weather'])) {
			wp_send_json_error(['message' => 'Empty data']);
		}

		$html = ViewsLoader::load( 'widget.php', [
			'atts'    => $_POST['atts'],
			'place'   => $_POST['place'],
			'temp'    => $_POST['temp'],
			'wind'    => $_POST['wind'],
			'weather' => $_POST['weather']
		] );

		wp_send_json_success(['html' => $html]);
	}

	public static function loadAssets() {
		wp_enqueue_style('ww-styles');
		wp_enqueue_script('ww-scripts');
		wp_localize_script('ww-scripts', 'wwSettings', [
			'apiKey' => get_option('ww-api-key'),
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'widgets' => static::$LocalizeScriptData
		]);
	}

}
