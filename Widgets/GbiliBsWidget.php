<?php
/**
 * Base class, extend this one to get lots of
 * functionalities. Have a look at GbiliBsThumbTitle
 * to see how.
 */
class GbiliBsWidget
{

    /**
     * Data used for rendering
     * @var array
     */
    protected $data;

    /**
     * User defined span size 
     * @var integer 
     */
    protected $custom_span_size = null;

    /**
     * The collection that generated this widget
     * @var GbiliBsThumbCollection
     */
    protected $collection;

    /**
     * Every widget is added one after the other to
     * the collection. This number represents: 
     * after how many other widgets it was added to
     * the collection
     * @var integer 
     */
    protected $position_in_collection = null;

    /**
     * Has the enclosing html already been output
     * @var integer 
     */
    static protected $row_opened = false;

    /**
     * @param array $data parts used in the html rendering:
     * title, widget_src, description etc... What are valid 
     * parts is defined (by subclasses) in needed_keys().
     */
    public function __construct(array $data)
    {
        if (!self::is_enough_data_to_construct($data)) {
            throw new Exception('Cannot construct from data provided: ' . print_r($data, true));
        }
        $this->data = $data;
    }

    public function set_span_size($size)
    {
        $this->custom_span_size = $size;
        return $this;
    }

    public function get_span_size()
    {
        if (null !== $this->custom_span_size) {
            return $this->custom_span_size;
        }

        if (!$this->has_collection()) {
            throw new Exception('You must set the span size manually since there is no collection attached to this widget');
        }
        return $this->get_collection()->get_widgets_span_size();
    }

    public function set_collection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function get_collection()
    {
        if (!$this->has_collection()) {
            throw new Exception('No collection has been set');
        }
        return $this->collection;
    }

    public function has_collection()
    {
        return null !== $this->collection;
    }

    public function get_position()
    {
        if (null === $this->position_in_collection) {
            throw new Exception('Position in collection not set');
        }
        return $this->position_in_collection;
    }

    public function set_position($number)
    {
        if (!$this->has_collection()) {
            throw new Exception('You cannot set the position until a collection has been set');
        }
        $this->position_in_collection = $number;
        return $this;
    }


    static public function set_row_open()
    {
        if (true === self::$row_opened) {
            throw new Exception('Close row before open new one');
        }
        self::$row_opened = true;
    }

    static public function set_row_close()
    {
        if (false === self::$row_opened) {
            throw new Exception('Open row before closing it');
        }
        self::$row_opened = false;
    }

    static public function open_row($collection)
    {
        self::set_row_open();
        ?><div class="row" <?php echo (($collection->has_id())? 'id="' . $collection->get_id() . '"' : '') ?>><?php       
    }

    static public function close_row($collection)
    {
        self::set_row_close();
        ?></div><?php       
    }

    public function render()
    { 
      ?><h1>Snip snap snappy, snappy, snappy, snappy!</h1>
        <p>This class is meant to be extended do not use as is</p><?php 
    }

    public function __call($get_name, $arguments)
    {
        $name = substr($get_name, 4);
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        throw new Exception('Requested attribute does not exist: ' . print_r($name, true) . '. Probably needed_keys does not include the key you are using.');
    }


    static public function is_enough_data_to_construct(array $data)
    {
        $missing_keys = array_diff(static::needed_keys(), array_keys($data));
        return empty($missing_keys);
    }

    static public function needed_keys()
    {
        return array();
    }
}
