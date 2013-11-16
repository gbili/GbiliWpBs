<?php
namespace Gbili\BsWidget\Widget;

require_once 'Thumb.php';

class SliderCarouselThumbSelector extends Thumb
{
    static public function needed_keys()
    {
        return array('thumb_src', 'thumb_alt');
    }

    static public function open_row($collection)
    {
        self::set_row_open();

        ?><div class="row">
            <div class="span12" id="slider">
              <!-- Top part of the slider -->
              <div class="row">
                <div class="span12" id="carousel-bounding-box">
                  <div class="carousel slide" id="myCarousel">
                   <!-- Carousel items -->
                   <div class="carousel-inner"><?php
    }

    public function render()
    {
                  ?><div class="item ' . <?php echo (($this->get_position() === 0)? 'active' : '')?> " data-slide-number=" <?php echo $this->get_position()?> ">
                      <img src="<?php echo $this->get_thumb_src()?>" alt="<?php echo $this->get_thumb_alt()?>">
                    </div><?php

    }

    static public function close_row($collection)
    {
        self::set_row_close();

                     ?></div><!-- Carousel nav -->
                       <a class="carousel-control left" data-slide="prev" href="#myCarousel">‹</a>
                       <a class="carousel-control right" data-slide="next" href="#myCarousel">›</a>
                    </div>
                </div> <!-- end carousel-bounding-box --> 
              </div> <!-- end row -->
           </div><!-- end div id=Slider -->
        </div><!--/Slider--><?php
        self::render_selector_thumbs($collection);
    }

    static public function render_selector_thumbs($collection)
    {
        $widgetizer = $collection->get_widgetizer();
        $collection_of_thumb_links = $widgetizer->get_a_collection('ThumbCarousel');
        $collection_of_thumb_links->render();
    }
}
