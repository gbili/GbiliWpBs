<?php
require_once 'GbiliBsWidgetCollection.php';

class GbiliBsWidgetizer
{
    protected $widgets_data = array();

    public function __construct(array $widgets_data)
    {
        $this->add($widgets_data);
    }

    public function add(array $widgets_data)
    {
        $this->widgets_data = array_merge($this->widgets_data, $widgets_data);
    }

    public function get_a_collection($widgets_of_class = null)
    {
        $widget_collection = new GbiliBsWidgetCollection($this->get_widgets_data(), $widgets_of_class);
        return $widget_collection->set_widgetizer($this);
    }

    public function get_widgets_data()
    {
        return $this->widgets_data;
    }
}
