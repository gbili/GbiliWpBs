<?php
require_once 'GbiliBsSliderCarouselThumbSelector.php';

class GbiliBsSliderCarouselTextThumbSelector extends GbiliBsSliderCarouselThumbSelector
{
    static public function close_row($collection)
    {
        self::set_row_close();

                ?></div><!-- Carousel nav -->
                  <a class="carousel-control left" data-slide="prev" href="#myCarousel">‹</a>
                  <a class="carousel-control right" data-slide="next" href="#myCarousel">›</a>
                </div>
              </div> <!-- end carousel-bounding-box -->
              <div class="span<?php echo $span_size_text_beside_slider?>" id="carousel-text"></div>
                <div id="slide-content" style="display: none;">
                  <div id="slide-content-0">
                    <h2><?php the_title()?></h2>
                    <?php the_content()?>
                  </div>
                </div>
              </div> <!-- end carousel-text -->
            </div> <!-- end row -->
          </div><!-- end div id=Slider -->
        </div><!--/Slider--><?php
        self::render_selector_thumbs($collection);
    }
}
