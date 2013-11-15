<?php

class GbiliBsWidgetFactory
{
    static protected $widget_classes_by_needed_keys_count = array();

    static protected $registered_widget_classes = array();

    static protected $registered_classes_needed_keys = array();

    static public function factory(array $data, $class=null)
    {
        if (null === $class) {
            $class = self::guess_class($data);
        } else {
            $class = self::check_provided_data($data, $class);
        }
        return new $class($data);
    }

    static public function register_widget_classes(array $classes)
    {
        foreach ($classes as $class) {
            self::register_widget_class($class);
        }
        krsort(self::$widget_classes_by_needed_keys_count);
    }

    static public function register_widget_class($class)
    {
        if (!self::can_register_widget_class($class)) {
            throw new Exception('Parameter class cannot be registered: ' . print_r($class, true));
        }
        self::$widget_classes_by_needed_keys_count[self::init_key_count($class)][] = $class;
        self::$registered_widget_classes[] = $class;
        self::add_registered_class_needed_keys($class);
    }

    static public function get_registered_classes_needed_keys()
    {
        return self::$registered_classes_needed_keys;
    }

    static public function add_registered_class_needed_keys($class)
    {
        self::$registered_classes_needed_keys = array_merge(self::$registered_classes_needed_keys, array_diff($class::needed_keys(), self::$registered_classes_needed_keys));
    }

    static public function init_key_count($class)
    {
        $widget_class_needed_keys_count = count($class::needed_keys());
        if (!isset(self::$widget_classes_by_needed_keys_count[$widget_class_needed_keys_count])) {
            self::$widget_classes_by_needed_keys_count[$widget_class_needed_keys_count] = array();
        }
        return $widget_class_needed_keys_count;
    }

    static public function check_provided_data(array $data, $class)
    {
        if (!self::is_class_usable($class)) {
            throw new Exception('The specified class cannot be used as a widget : ' . $class);
        }

        if (!$class::is_enough_data_to_construct($data)) {
            throw new Exception(self::cannot_construct_error_message($data));
        }
        return $class;
    }

    static protected function cannot_construct_error_message($data)
    {
        $message = 'No widget class can be constructed from the data provided: ' . print_r($data, true) . ".\n";
        $good_keys = array_intersect(array_keys($data), self::get_registered_classes_needed_keys());
        if (empty($good_keys)) {
            $message .= 'You are not using good keys for your fields. Here are the keys that you can use: ' . print_r(self::get_registered_classes_needed_keys(), true) . ".\n";
        } else {
            $message .= "You are using good keys but you do not have the least required.\n";
        }
        return $message;
    }

    static public function can_register_widget_class($class)
    {
        return self::is_class_usable($class) && !in_array($class, self::$registered_widget_classes);
    }

    static public function is_class_usable($class)
    {
        return class_exists($class) && method_exists($class, 'is_enough_data_to_construct');
    }

    static public function guess_class(array $data)
    {
        foreach (self::$widget_classes_by_needed_keys_count as $keys_count => $widget_classes_with_same_data_keys_count) {
            foreach ($widget_classes_with_same_data_keys_count as $widget_class) {
                if ($widget_class::is_enough_data_to_construct($data)) {
                    return $widget_class;
                }
            }
        }
    }
}
