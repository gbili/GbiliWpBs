# What is this?

This wordpress plugin allows you to easily display thumbnails, carousels, sliders etc. from Twitter Bootstrap. You can easily extend it to create your own widgets, with a minimum of code.

# Requirements

You need a wordpress theme that comes packaged with twitter bootstrap.

# How to install?

Copy the containing directory to your wordpress plugins directory

# How to use?

## Use what is already packaged

To use the Widgets that come built in, simply use the global function:
    gbili_bs_echo_widgets(
        array(
            array(
                'thumb_src' => 'http://gbili.com/wp-content/uploads/some-picture.jpg'
                'thumb_alt' => 'some picture'),
            array(
                'thumb_src' => 'http://gbili.com/wp-content/uploads/some-other-picture.jpg'
                'thumb_alt' => 'some other picture'),
            array(
                'thumb_src' => 'http://gbili.com/wp-content/uploads/as-many-as-you-want.jpg'
                'thumb_alt' => 'really you can add as many as 12 images, otherwise it will look bad'),
        ),
        'GbiliBsThumb'
    );`

If you don't specify the widget class name, GbiliBsFactory will try to figure one that matches your widget keys (e.g. `thumb_src` would trigger the `GbiliBsSliderCarouselThumbSelectorSingle` or `GbiliBsCarouselSingle`).

## Take advantage of Wordpress custom fields

This plugin has been designed to work with Wordpress Custom fields. The point is to create some custom fields, either in custom post types or in standard posts, and then get those fields with: `get_post_meta($post_id)` 

You can then directly inject the meta into a widget to display it nicely:
`gbili_bs_echo_widgets(gbili_get_post_meta(get_the_ID(), array('thumb_src', 'thumb_alt')), 'GbiliBsThumb');`

To see `gbili_get_post_meta()` internals visti [gbili-get-post-meta].

[gbili-get-post-meta]: http://gbili.com/dev/wp-meta-functions "this post"

## Create custom widgets

To create custom widgets take a look at the ones that come packaged in: `GbiliWpBs/Widgets` and create your own by extending the base class: `GbiliBsWidget` 

# Support 

Visit [gbili-com-gbiliwpbs-support]

[gbili-com-gbiliwpbs-support]: http://gbili.com/dev/gbiliwpbs-support "the support page"
