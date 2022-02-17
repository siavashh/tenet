<?php
// Creating the widget 
class tenet_popular_post_widget extends WP_Widget {
  
function __construct() {
    parent::__construct(
        'tenet_popular_post_widget', // Base ID
        esc_html__('Popular Posts', 'tenet'), // Name
        array('description' => esc_html__('A Popular Post Widget', 'tenet'),) // Args
    );
}
  
// Creating widget front-end
public function widget( $args, $instance ) {
// $postTitle = apply_filters( 'widget_title', $instance['title'] );
  
// // before and after widget arguments are defined by themes
// echo $args['before_widget'];
// if ( ! empty( $postTitle ) )
// echo $args['before_title'] . $postTitle . $args['after_title'];
  
// // This is where you run the code and display the output
// echo __( 'Hello, World!', 'tenet' );
// echo $args['after_widget'];


        $postTitle = isset($instance['title']) ? $instance['title'] : '';
		$postscount = isset($instance['posts']) ? $instance['posts'] : '';
		$thumbnail = $instance['thumbnail'] ? true : false;

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
    ?>

        <ol <?php echo ('on' == $instance[ 'thumbnail' ]) ? 'class="with-thumb"' : 'class="no-thumb"'; ?>>

			<?php
			global $wpdb;

			$posts = $wpdb->get_results("SELECT comment_count, ID, post_title, post_author FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0, $postscount"); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared

			foreach ($posts as $post) {
				setup_postdata($post);
				$id = $post->ID;
				$postTitle = $post->post_title;
				$count = $post->comment_count;
				$author = __('by', 'tenet') . ' ' . get_the_author_meta('display_name', $post->post_author);

				if ($thumbnail) {
                    add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
					printf('<li><a href="%s" title="%s"><div class="post-thumbnail">%s</div><div class="post-title"><h3>%s</h3><small class="post-author">%s</small> -<small class="post-comments"><i class="fa fa-comment-o"></i>%s</small></div></a></li>', 
                    esc_attr(get_permalink($id)), esc_attr($postTitle), get_the_post_thumbnail($post->ID, 'tenet_sidebar-image'), esc_html($postTitle), esc_html($author), esc_html($count)); 
                    remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' );

				} else {
					printf('<li><a href="%1$s" title="%2$s"><div class="post-title"><h3>%2$s</h3><small class="post-author">%3$s</small> -<small class="post-comments"><i class="fa fa-comment-o"></i>%4$s</small></div></a></li>', 
                    esc_attr(get_permalink($id)), esc_attr($postTitle), esc_html($author), esc_html($count)); 
				}
			}
			?>
		</ol>

	<?php

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


}
          
// Widget Backend 
public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
        $postTitle = $instance[ 'title' ];
    }
    else {
        $postTitle = __( 'New title', 'tenet' );
    }
    if ( isset( $instance[ 'title' ] ) ) {
        $posts = $instance[ 'posts' ];
    }
    else{
        $posts = 5;
    }
    // Widget admin form
?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'tenet'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $postTitle; ?>">
        <label for="<?php echo $this->get_field_id('posts'); ?>"><?php esc_html_e('Number of Posts:', 'tenet'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" type="text" value="<?php echo $posts; ?>">
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'thumbnail' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail' ); ?>" /> 
        <label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php esc_html_e('Show post thumbnails', 'tenet'); ?></label>
    </p>  
<?php 
}
      
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
    $instance['posts'] = (!empty($new_instance['posts'])) ? sanitize_text_field($new_instance['posts']) : '';
    $instance['thumbnail'] = (!empty($new_instance['thumbnail'])) ? sanitize_text_field($new_instance['thumbnail']) : ''; 
    return $instance;
}
 
// Class tenet_popular_post_widget ends here
} 
 
 
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'tenet_popular_post_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );