<?php
namespace Gbili\BsWidget;

require_once 'Factory.php';

class Collection
{
    protected $rendered = false;

    protected $collection_creator;

    /**
     * Id used when opening the row
     * @var string 
     */
    protected $id;

    protected $widgets_span_size;

    protected $filled_empty_spaces_count = 0;

    protected $widgets = array();

    public function __construct(array $widgets_data, $widgets_of_class=null)
    {
        foreach ($widgets_data as $widget_data) {
            $this->add(Factory::factory($widget_data, $widgets_of_class));
        }
    }

    protected function add( $widget)
    {
        $this->widgets[] = $widget;
        $widget->set_collection($this);
        $widget->set_position($this->get_count() - 1);
        $this->update_widgets_span_size();
    }

    public function get_collection_creator()
    {
        return $this->collection_creator;
    }

    public function set_collection_creator(CollectionCreator $collection_creator)
    {
        $this->collection_creator = $collection_creator;
        return $this;
    }

    public function get_count()
    {
        return count($this->widgets);
    }

    public function render()
    {
        if ($this->rendered) {
            throw new Exception('You cannot render more than once, create a different collection. If you really want to re-render the same collection twice, use buffers: ob_start(), ob_get_clean() etc.');
        }
        $widget_class = get_class(current($this->widgets));
        $widget_class::open_row($this);
        $widget_class::fill_empty_space($this);
        foreach ($this->widgets as $widget) {
            $widget->render();
        }
        $widget_class::fill_empty_space($this);
        $widget_class::close_row($this);
        $this->rendered = true;
    }

    public function fill_empty_space()
    {
        if (2 <= $this->filled_empty_spaces_count) {
            throw new Exception('Trying to fill empty space more than twice');
        }
        $empty_space_span = 12 - $this->get_widgets_span_size() * $this->get_count();
        $rest = $empty_space_span % 2;
        $one_empty_space_span = ($empty_space_span - $rest) / 2;
        if ($one_empty_space_span) {
            ?><div class="span<?php echo $one_empty_space_span ?>"></div><?php
        }
        ++$this->filled_empty_spaces_count;
    }

    public function get_id()
    {
        if (null === $this->id) {
            throw new Exception('The widget class that you use, requires that you set a collection id');
        }
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
        return $this;
    }

    public function has_id()
    {
        return null !== $this->id;
    }

    public function update_widgets_span_size()
    {
        $this->widgets_span_size = ($this->get_count() <= 12)? ((12-(12 % $this->get_count())) / $this->get_count()) : 1;
    }

    public function get_widgets_span_size()
    {
        return $this->widgets_span_size;
    }
}
