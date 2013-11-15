<?php
require_once 'GbiliBsThumb.php';

class GbiliBsThumbCarousel extends GbiliBsThumb
{
    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt');
    }

    static public function open_row($collection)
    {
        self::set_row_open();

        ?><div class="row" id="<?php (($collection->has_id())? $collection->get_id() : 'thumbs')?>">
            <div class="span12">
                <!-- Bottom switcher of slider -->
                <ul class="thumbnails"><?php       
    }

    public function render()
    {
                  ?><li class="span<?php echo $this->get_span_size()?>">
                      <a class="thumbnail" id="carousel-selector-<?php echo $this->get_position()?>">
                        <img src="<?php echo $this->get_thumb_src(); ?>" alt="<?php echo $this->get_thumb_alt(); ?>">
                      </a>
                    </li><?php 
    }

    static public function close_row($collection)
    {
        self::set_row_close();

              ?></ul>
            </div>
        </div><?php       
    }
}
