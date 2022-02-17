<?php

/**
 * Range Slider Control
 * Tenet 0.1.0
 */
if (!class_exists('WP_Customize_Control'))
    return NULL;

class tenet_range_slider extends WP_Customize_Control
{

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @since  1.1
     * @var    string
     */
    public $type = 'range-slider';
    public $max;
    public $default;


    public function enqueue()
    {
        wp_enqueue_script('tenet_range-slider', get_template_directory_uri() . '/inc/theme-settings/js/range-slider.js', array('jquery'), false, true);
    }

    public function render_content()
    {
        $name = '_customize-range-slider-' . $this->id;
?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <div class="controls" id="tenet-range-slider-container-<?php echo esc_attr($name); ?>">
            <input class='tenet-range-slider' <?php echo esc_html($this->link()); ?> type="range" max="<?php echo esc_html($this->max); ?>" value="<?php echo !empty($this->value) ? esc_attr($this->value) : esc_attr($this->default) ?>" name="<?php echo esc_attr($name); ?>" />
            <div class="slider-value">slider</div>
        </div>
<?php
    }
}
