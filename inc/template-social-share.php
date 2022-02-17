<?php
/* Social Share Buttons template for WordPress
 * By Daan van den Bergh 
 */

//$tenet_postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
$tenet_postUrl = get_permalink();
$tenet_postTitle = get_the_title();

?>
<section class="sharing-box content-margin content-background clearfix">
    <h5 class="sharing-box-name"><?php esc_html_e("Don't be selfish. Share the knowledge!", 'tenet') ?></h5>
    <div class="share-button-wrapper">

        <li>
            <a target="_blank" class="share-button share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($tenet_postUrl); ?>&text=<?php  echo esc_attr($tenet_postTitle); ?>&via=<?php  echo esc_attr(the_author_meta('twitter')); ?>" title="Tweet this">
            </a>
        </li>
        <li>
            <a target="_blank" class="share-button share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php  echo esc_attr($tenet_postUrl); ?>" title="<?php esc_attr_e("Share on Facebook", "tenet") ?>">
            </a>
        </li>

        <li>
            <a target="_blank" class="share-button share-telegram" href="https://t.me/share/url?url=<?php  echo esc_attr($tenet_postUrl); ?>&text=<?php  echo esc_attr($tenet_postTitle); ?>" title="<?php esc_attr_e("Share on Telegram", "tenet") ?>">
            </a>
        </li>

    </div>
</section>