<?php
require_once 'GbiliBsThumb.php';

class GbiliBsThumbLinkTitle extends GbiliBsThumb
{
    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt', 'thumb_link', 'thumb_title');
    }

    public function render()
    { ?>
      <div class="span<?php echo $this->get_span_size();?>">
        <div class="thumbnail">
          <a href="<?php echo $this->get_thumb_link();?>">
            <img src="<?php echo $this->get_thumb_src();?>" alt="<?php echo $this->get_thumb_alt();?>">
            <div class="caption">
                <h3><?php echo $this->get_thumb_title();?></h3>
            </div>
          </a>
        </div>
      </div>
<?php 
    }
}
