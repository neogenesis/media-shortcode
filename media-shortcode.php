<?php
/**
 * Plugin Name: Media Shortcode
 * Plugin URI: https://github.com/neogenesis/media-shortcode
 * Description: Easy Shortcode to show images and everything from media 
 * Version: 0.1
 * Author: Niel Singson
 * Author URI: https://github.com/neogenesis
 */

    
add_shortcode( 'media', 'neo_media_shortcode' );
function neo_media_shortcode( $atts ) {
    $attr = shortcode_atts( array(
        'id' => 0,
        'add_link' => '0',
        'size' => 'full'
    ), $atts );

    $plugin_url = plugin_dir_url( __FILE__ );
    if( intval( $attr['id'] ) > 0 ) {
        $img_attr = wp_get_attachment_image_src( $attr['id'], $attr['size'] );
    }
    if( empty( $img_attr ) ) {
        $img_attr = [ $plugin_url . 'img/robot.png', 256, 256 ] ;
    }
    ob_start();
    if( $attr['add_link'] == true ) {
        echo '<a href="' . $img_attr[0] . '">';
    }
    ?>
    <img src="<?php echo $img_attr[0] ?>" width="<?php echo $img_attr[1]; ?>" height="<?php echo $img_attr[2]; ?>" />
    <?php
    if( $attr['add_link'] == true ) {
        echo '</a>';
    }
    return ob_get_clean();
}
