<?php

use \Elementor\Plugin as Plugin;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

final class Slicko_Extension
{

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
	const MINIMUM_PHP_VERSION = '5.6';


	private static $_instance = null;

	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function __construct()
	{

		add_action('init', [$this, 'i18n']);
		add_action('plugins_loaded', [$this, 'init']);
	}

	public function i18n()
	{
		load_plugin_textdomain('slicko');
	}



	public function init()
	{
		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return;
		}
		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return;
		}

		//add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'pawelements_editor_styles' ) );
		add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
		add_action('elementor/elements/categories_registered', [$this, 'register_new_category']);
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'slicko_editor_scripts_js'], 100);
		add_action('wp_enqueue_scripts', array($this, 'slicko_register_frontend_styles'), 10);
		add_action('elementor/frontend/before_register_scripts', [$this, 'slicko_register_frontend_scripts']);
	}

	/**
	 * Load Frontend Script
	 *
	 */
	public function slicko_register_frontend_scripts()
	{
		wp_enqueue_style(
			'slicko-addons-style',
			SLICKO_ASSETS_PUBLIC . '/css/widget-style.css',
			null,
			SLICKO_VERSION,
		);
		wp_enqueue_style(
			'extra-css-style',
			SLICKO_ASSETS_PUBLIC . '/css/extra.css',
			null,
			SLICKO_VERSION,
		);
		wp_enqueue_style(
			'creative-button',
			SLICKO_ASSETS_PUBLIC . '/css/creative-button.css',
			null,
			SLICKO_VERSION,
		);

		wp_enqueue_style(
			'inline-button',
			SLICKO_ASSETS_PUBLIC . '/css/inline-button.css',
			null,
			SLICKO_VERSION,
		);

		wp_enqueue_style(
			'slick',
			SLICKO_ASSETS_PUBLIC . '/css/slick.css',
			null,
			SLICKO_VERSION,
		);


		// Add Slicko MAP API
		$slicko_map = get_theme_mods('slicko_map_api_settings');
		$mapApi = isset($slicko_map['slicko_map_api_settings']) ? $slicko_map['slicko_map_api_settings'] : 1;
		if ('1' !== $mapApi) {
			$api = sprintf('https://maps.googleapis.com/maps/api/js?key=%1$s&language=%2$s', $mapApi, 'en');
			wp_register_script('slicko-maps-api-input', $api, array(), '', false);
		}
		wp_enqueue_script(
			'slicko-maps-api-js',
			SLICKO_ASSETS_PUBLIC . '/js/slicko-maps.js',
			['jquery'],
			SLICKO_VERSION,
			true
		);
		wp_enqueue_script(
			'typed',
			SLICKO_ASSETS_PUBLIC . '/js/typed.min.js',
			['jquery'],
			SLICKO_VERSION,
			true
		);

		wp_enqueue_script(
			'slick',
			SLICKO_ASSETS_PUBLIC . '/js/slick.min.js',
			['jquery'],
			SLICKO_VERSION,
			true
		);

		// widget js
		wp_enqueue_script(
			'slicko-addons-script',
			SLICKO_ASSETS_PUBLIC . '/js/widget.js',
			array('jquery'),
			SLICKO_VERSION,
			true
		);
	}

	public function slicko_editor_scripts_js()
	{

		wp_enqueue_script(
			'slicko-addons-editor',
			SLICKO_ASSETS_PUBLIC . '/js/editor.js',
			['jquery'],
			SLICKO_VERSION,
			true
		);
	}


	/**
	 * Load Frontend Styles
	 *
	 */
	public function slicko_register_frontend_styles()
	{
		wp_enqueue_style(
			'themify-icons',
			SLICKO_ASSETS_PUBLIC . '/vendor/themify-icons/themify-icons.css',
			null,
			SLICKO_VERSION
		);
	}

	/**
	 * Widgets Catgory
	 *
	 */
	public function register_new_category($manager)
	{
		$manager->add_category(
			'slicko',
			[
				'title' => __('Slicko Elementor Helper  Addons', 'slicko'),
			]
		);
	}

	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'slicko'),
			'<strong>' . esc_html__('Elementor Pawelements Extension', 'slicko') . '</strong>',
			'<strong>' . esc_html__('PHP', 'slicko') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'slicko'),
			'<strong>' . esc_html__('Elementor slicko Extension', 'slicko') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'slicko') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'slicko'),
			'<strong>' . esc_html__('Elementor Slicko Extension', 'slicko') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'slicko') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	public function init_widgets()
	{

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		/* 
		* Extensions Include
		*/
		require_once(SLICKO_WIDGET_EXTENSIONS . 'custom-css.php');
		require_once(SLICKO_WIDGET_EXTENSIONS . 'container-control.php');
		require_once(SLICKO_WIDGET_EXTENSIONS . 'css-transform.php');
		require_once(SLICKO_WIDGET_EXTENSIONS . 'custom-position.php');
		require_once(SLICKO_WIDGET_EXTENSIONS . 'floting-effect.php');








		//Include Widget files
		require_once(SLICKO_WIDGET_DIR . 'Menu/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Logo/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'IconBox/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Breadcrumb/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'ContactForm7/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Excerpt/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Heading/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'FeatureImage/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'DualHeading/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Popup/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'VideoButton/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'CreativeButton/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'PricingBox/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Accordion/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'AniamteText/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'Search/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'DualButton/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'InlineButton/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'AdvanceSlider/widget.php');
		require_once(SLICKO_WIDGET_DIR . 'GoogleMap/widget.php');
	}
}
Slicko_Extension::instance();
