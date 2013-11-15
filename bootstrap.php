<?php
/**
 * @package Gbili_Bs_Widgets
 * @version 1.6
 */
/*
Plugin Name: Gbili Bs Widgets 
Plugin URI: http://wordpress.org/extend/plugins/gbili-bs/
Description: Use packaged widgets and display your posts in a cooliful manner.
Author: Guillermo Devi
Version: 0.1
Author URI: http://c.onfi.gs/
*/
defined('GBILI_DIR') || define('GBILI_DIR', realpath(dirname(__FILE__)));
defined('GBILI_THUMB_CLASSES_DIR') || define('GBILI_THUMB_CLASSES_DIR',  GBILI_DIR . '/Widgets');

require_once GBILI_DIR . '/src/GbiliBsWidgetsApp.php';
require_once GBILI_DIR . '/src/GbiliBsWidgetizer.php';

GbiliBsWidgetsApp::init();

function gbili_bs_echo_widgets(array $widgets_data, $of_widget_class = null) {
    $widgetizer = new GbiliBsWidgetizer($widgets_data);
    $widgets_collection = $widgetizer->get_a_collection($of_widget_class);
    $widgets_collection->render();
}
