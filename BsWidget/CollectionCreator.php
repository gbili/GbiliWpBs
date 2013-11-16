<?php
namespace Gbili\BsWidget;

require_once 'Collection.php';

class CollectionCreator
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
        $widget_collection = new Collection($this->get_widgets_data(), $widgets_of_class);
        return $widget_collection->set_collection_creator($this);
    }

    public function get_widgets_data()
    {
        if (empty($this->widgets_data)) {
            throw new \Exception('The widgets data is empty. Either not set or you passed an empty array.');
        }
        return $this->widgets_data;
    }
}
