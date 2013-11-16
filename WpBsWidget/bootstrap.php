<?php
namespace Gbili\WpBsWidget;
/**
 * @package GbiliWpBs
 * @version 1.6
 */
/*
Plugin Name: Gbili Wordpress Bootstrap
Plugin URI: http://wordpress.org/extend/plugins/gbili-wp-bs/
Description: Use packaged widgets and display your posts like a pimp.
Author: Guillermo Devi
Version: 0.1
Author URI: http://c.onfi.gs/
*/

defined('GBILI_DIR') || define('GBILI_DIR', realpath(dirname(__FILE__) . '/..'));
defined('GBILI_BSWIDGET_DIR') || define('GBILI_BSWIDGET_DIR',  GBILI_DIR . '/BsWidget');

require_once GBILI_BSWIDGET_DIR . '/Application.php';
require_once GBILI_BSWIDGET_DIR . '/CollectionCreator.php';

\Gbili\BsWidget\Application::init();

function gbili_bs_echo_widgets(array $widgets_data, $of_widget_class = null) {
    $widgetizer = new \Gbili\BsWidget\CollectionCreator($widgets_data);
    $widgets_collection = $widgetizer->get_a_collection($of_widget_class);
    $widgets_collection->render();
}
