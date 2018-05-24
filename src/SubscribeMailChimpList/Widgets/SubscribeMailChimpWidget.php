<?php

namespace SubscribeMailChimpList\Widgets;

use SubscribeMailChimpList;
use SubscribeMailChimpList\Classes\Admin;
use SubscribeMailChimpList\Utils\WidgetHelper;
use WP_Widget;

class SubscribeMailChimpWidget extends WP_Widget
{
    use WidgetHelper;

    public $css = true;

    private $textdomain = __NAMESPACE__;

    private $suffix = " - SubscribeMailChimpWidget";

    private $default_options = [];

    function __construct()
    {
        $this->default_options = $this->default_options();

        $this->textdomain = SubscribeMailChimpList::$textdomine;

        $className = get_called_class();

        $className = str_replace("\\", '-', $className);

        parent::__construct(
            $className,
            __("Subscribe widget ", 'SubscribeMailChimpList') . $this->suffix,
            [
                'description' => __("Mailchimp subscribe form", 'SubscribeMailChimpList') . $this->suffix
            ]
        );
    }

    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        echo "<div class='SubscribeMailChimpList__form-wrapper-widget'>";
        echo apply_filters('SubscribeMailChimpList__shortcode-content', ['title' => $instance['title']]);
        echo "</div>";

        echo $args['after_widget'];
    }

    public function form($instance)
    {

        if (!isset($instance['title'])) {
            $instance['title'] = __('Subscribe to our newsletter', 'SubscribeMailChimpList');
        }

        if (!isset($instance['api_key'])) {
            $instance['api_key'] = $this->default_options['api_key'];
        }

        if (!isset($instance['list_id'])) {
            $instance['list_id'] = $this->default_options['list_id'];
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title', 'SubscribeMailChimpList'); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   type="text" value="<?php echo esc_attr($instance['title']); ?>"/>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('api_key'); ?>">
                <?php _e('Custom API Key', 'SubscribeMailChimpList'); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id('api_key'); ?>"
                   name="<?php echo $this->get_field_name('api_key'); ?>"
                   type="text"
                   placeholder="<?php echo esc_attr( $this->default_options['api_key']);?>"
                   value="<?php echo esc_attr($instance['api_key']); ?>"/>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('list_id'); ?>">
                <?php _e('Custom List id', 'SubscribeMailChimpList'); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id('list_id'); ?>"
                   name="<?php echo $this->get_field_name('list_id'); ?>"
                   type="text"
                   placeholder="<?php echo esc_attr( $this->default_options['list_id']);?>"
                   value="<?php echo esc_attr($instance['list_id']); ?>"/>

        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance['title'] = esc_textarea($new_instance['title']);
        $instance['api_key'] = esc_textarea($new_instance['api_key']);
        $instance['list_id'] = esc_textarea($new_instance['list_id']);

        return $instance;
    }


    public function default_options()
    {
        $options = [
            'api_key' => get_option(Admin::$option_prefix . 'api_key', false),
            'list_id' => get_option(Admin::$option_prefix . 'list_id', false)
        ];

        return $options;
    }
}