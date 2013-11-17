<?php
namespace Gbili\BsWidget\Widget;

require_once 'Thumb.php';

class ThumbTitle extends Thumb
{
    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt', 'thumb_title');
    }

    public function inner_render()
    {
    ?><div class="span<?php echo $this->get_span_size();?>">
        <div class="thumbnail">
          <img src="<?php echo $this->get_thumb_src();?>" alt="<?php echo $this->get_thumb_alt();?>">
          <div class="caption">
            <h3><?php echo $this->get_thumb_title();?></h3>
          </div>
        </div>
      </div><?php 
    }
}
