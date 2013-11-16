<?php
namespace Gbili\BsWidget\Widget;

require_once 'Widget.php';

class Thumb extends Widget
{

    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt');
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
    { ?>
      <div class="span<?php echo $this->get_span_size();?>">
        <div class="thumbnail">
          <img src="<?php echo $this->get_thumb_src();?>" alt="<?php echo $this->get_thumb_alt();?>">
        </div>
      </div>
<?php 
    }
}
