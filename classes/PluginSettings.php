<?php

namespace WeatherWidget\classes;

use WeatherWidget\App;
use WeatherWidget\helpers\ViewsLoader;

class PluginSettings {

	public static function init() {
		add_action( 'admin_menu', [__CLASS__, 'addSettingsPage'] );
	}

	public static function addSettingsPage() {
		add_menu_page( __('Weather Widget Settings', App::TEXT_DOMAIN), __('Weather Widget Settings', App::TEXT_DOMAIN), 'manage_options', 'ww-settings', [__CLASS__, 'renderSettingsPage']);
	}

	public static function renderSettingsPage() {
		self::saveSettings();
		echo ViewsLoader::load('admin-settings.php');
	}

	public static function saveSettings() {
		if(isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'])) {
			foreach ($_POST as $setting_slug => $value) {
				if(strpos($setting_slug, 'ww') !== false) {
					update_option($setting_slug, $value);
				}
			}
		}
	}
}
