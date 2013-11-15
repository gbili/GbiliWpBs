<?php

require_once __DIR__ . '/GbiliClassDir.php';
require_once __DIR__ . '/GbiliBsWidgetFactory.php';

class GbiliBsWidgetsApp
{
    static protected $initialized = false;

    protected function __construct(){}

    static public function init()
    {
        if (self::$initialized) {
            return;
        }
        self::register_all_thumb_classes();
        self::$initialized = true;
    }

    static public function register_all_thumb_classes()
    {
        $class_dir = new GbiliClassDir(GBILI_THUMB_CLASSES_DIR);
        $class_dir->require_classes();
        GbiliBsWidgetFactory::register_widget_classes($class_dir->get_required_classes());
    }
}
