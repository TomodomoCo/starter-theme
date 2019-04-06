<?php

namespace Tomodomo\Theme;

// Shorthand for the current directory
$dir = dirname(__FILE__);

/**
 * Run the autoloader
 *
 * Running the autoloader in functions.php ensures the autoloaded
 * classes are available inside of functions.php, which is loaded
 * before the request makes it to index.php
 */
if (file_exists("{$dir}/build/composer/autoload.php")) {
    require "{$dir}/build/composer/autoload.php";
}

use Timber;
use Tomodomo\Theme\Models\Menu;
use Tomodomo\Theme\Models\Post;
use Tomodomo\Twig\Pluralize;
use Tomodomo\WpAssetRegistrar\Registrar;
use WP_Query;

/**
 * Get the base URL.
 *
 * @return string
 */
function baseUrl() : string
{
    return trailingslashit(get_stylesheet_directory_uri());
}

/**
 * Get the base directory.
 *
 * @return string
 */
function baseDir() : string
{
    return trailingslashit(get_stylesheet_directory());
}

/**
 * Add theme support
 *
 * @return void
 */
function themeSupports()
{
    // Featured images
    add_theme_support('post-thumbnails');

    // Disable Gutenberg colors
    add_theme_support('disable-custom-colors');

    // Disable Gutenberg custom font sizes
    add_theme_support('disable-custom-font-sizes');

    // Auto-generate the title tag
    add_theme_support('title-tag');

    return;
}

add_action('after_setup_theme', __NAMESPACE__ . '\\themeSupports');

/**
 * Register theme nav menus
 *
 * @return void
 */
function registerMenus()
{
    register_nav_menus([
        'nav-main'   => 'Main Menu',
        'nav-footer' => 'Footer Menu',
    ]);

    return;
}

add_action('init', __NAMESPACE__ . '\\registerMenus');

/**
 * Register sidebar areas
 *
 * @return void;
 */
function registerSidebars()
{
    // Set some default arguments
    $defaults = [
		'before_widget' => '<div class="o-widget %2$s">',
		'after_widget'  => '</div>',
        'before_title'  => '<h5 class="o-widget__title">',
        'after_title'   => '</h5>',
    ];

    $args = [
        [
            'name' => 'Sidebar',
            'id'   => 'sidebar',
        ],
    ];

    // Register each sidebar area
    foreach ($sidebars as $sidebar) {
        $args = wp_parse_args($sidebar, $defaults);

        register_sidebar($args);
    }

    return;
}

add_action('widgets_init', __NAMESPACE__ . '\\registerSidebars');

/**
 * Instantiate and register widgets
 *
 * @return void
 */
function registerWidgets()
{
    $widgets = [
        'Sample',
    ];

    foreach ($widgets as $widget) {
        // Instantiate the widget instance
        $className = __NAMESPACE__ . "\\Widgets\\{$widget}Widget";
        $widget    = new $className();

        // Register the widget
        register_widget($widget);
    }

    return;
}

add_action('widgets_init', __NAMESPACE__ . '\\registerWidgets');

/**
 * Add items to Timber context to access on views
 *
 * @param array $context
 *
 * @return array
 */
function context($context) : array
{
    // Load in menus
    $context['menu']['main']   = new Menu('nav-main');
    $context['menu']['footer'] = new Menu('nav-footer');

    // Path to compiled assets (for inline images)
    $context['assetPath'] = baseUrl() . 'build';

    // Primary sidebar
    $context['sidebar'] = Timber::get_widgets('sidebar');

    return $context;
}

add_filter('timber/context', __NAMESPACE__ . '\\context');

/**
 * Extend Timber's Twig instance
 *
 * @param Twig
 *
 * @return Twig
 */
function extendTwig($twig)
{
    $twig->addExtension(new Pluralize);

    return $twig;
}

add_filter('timber/twig', __NAMESPACE__ . '\\extendTwig');

/**
 * Handle asset registration
 *
 * @return void
 */
function assets()
{
    // Set up an asset registrar
    $registrar = new Registrar([
        'basePath' => baseDir(),
        'urlPath'  => baseUrl(),
    ]);

    // General CSS
    $registrar->addStyle('tf-css', 'build/assets/css/style.css');

    // General JS
    $registrar->addScript('tf-js', 'build/assets/js/script.js', [
        'dependencies' => [
            'jquery',
        ],
    ]);

    // Enqueue assets
    $registrar->enqueueStyles();
    $registrar->enqueueScripts();

    return;
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets');
