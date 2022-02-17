<?php

/**
 * Radio Image Control
 * Tenet 0.1.0
 */
if (!class_exists('WP_Customize_Control'))
    return NULL;

class tenet_new_Image_Radio_Control extends WP_Customize_Control
{
    public function enqueue()
    {
        wp_enqueue_script('tenet_image-radio', get_template_directory_uri() . '/inc/theme-settings/js/image-radio.js', array('jquery'), false, true);
    }

    public function render_content()
    {

        if (empty($this->choices))
            return;

        $name = '_customize-radio-' . $this->id;
?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <ul class="controls" id='tenet-img-container'>
            <?php
            foreach ($this->choices as $value => $label) :
                $class = ($this->value() == $value) ? 'tenet-radio-img-selected tenet-radio-img-img' : 'tenet-radio-img-img';
            ?>
                <li>
                    <label>
                        <input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
                                                                                                                                                                        $this->link();
                                                                                                                                                                        checked($this->value(), $value);
                                                                                                                                                                        ?> />
                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class . ' ' . $value); ?>' />
                    </label>
                </li>
            <?php
            endforeach;
            ?>
        </ul>
<?php
    }
}
