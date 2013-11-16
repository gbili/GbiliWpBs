<?php
namespace Gbili\BsWidget;

require_once __DIR__ . '/../ClassDir.php';
require_once 'Factory.php';

defined || define('GBILI_BSWIDGET_WIDGET_DIR', __DIR__ . '/Widget');

class Application
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
        $class_dir = new \Gbili\ClassDir(GBILI_BSWIDGET_WIDGET_DIR);
        $class_dir->require_classes();
        Factory::register_widget_classes($class_dir->get_required_classes());
    }
}
