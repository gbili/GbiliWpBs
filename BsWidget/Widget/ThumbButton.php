<?php
namespace Gbili\BsWidget\Widget;

require_once 'Thumb.php';

class ThumbButton extends Thumb
{
    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt', 'button_text', 'button_link');
    }

    public function inner_render()
    { 
   ?><div class="span<?php echo $this->get_span_size();?>">
        <div class="thumbnail">
          <img src="<?php echo $this->get_thumb_src();?>" alt="<?php echo $this->get_thumb_alt();?>">
          <div class="caption">
            <p>
              <a href="<?php echo $this->get_button_link();?>" class="btn btn-primary" role="button"><?php echo $this->get_button_text();?></a> 
            </p>
          </div>
        </div>
      </div><?php 
    }
}
