<?php
require_once 'GbiliBsThumb.php';

class GbiliBsThumbLink extends GbiliBsThumb
{
    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt', 'thumb_link');
    }

    public function render()
    { ?>
      <div class="span<?php echo $this->get_span_size();?>">
        <div class="thumbnail">
          <a href="<?php echo $this->get_thumb_link();?>">
            <img src="<?php echo $this->get_thumb_src();?>" alt="<?php echo $this->get_thumb_alt();?>">
          </a>
        </div>
      </div>
<?php 
    }
}
