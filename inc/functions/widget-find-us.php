<?php
/* 
Plugin Name: Find Us Widget 1
Plugin URI: #
Description: Testing Find Us Widget
Author: Nathaniel Schweinberg
Version: 1.0
Author URI: http://fightthecurrent.org/
*/

class Find_Us_Widget extends WP_Widget {
function Find_Us_Widget(){  
	$widget_options = array( 
		'classname'       => 'widget-find-us',
        'description'     => __('Random tidbits of trivia')
         );
	$control_options = array(
        'height'          => 300,
		'width'          => 250
        );
	$this->WP_Widget( 'find_us_widget', __('Find Us Widget'), $widget_options, $control_options );}

function widget( $args, $instance ){
    extract( $args, EXTR_SKIP );
    $title = ( $instance['title'] ) ? $instance['title'] : 'Find Us Widget';
    echo $before_widget;
    echo $before_title;
    echo esc__html( $instance['title'] );
    echo $after_title;
    echo '<p>8388 Collins Rd.<br>Nashville, TN<br>info@walnuttracefarm.com</p>';
    echo $after_widget;}

function form( $instance ){
    ?>
    <p> 
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">
         <?php _e( 'Title:' ); ?>
         <input id="<?php echo $this->get_field_id( 'title' ); ?>"
               name="<?php echo $this->get_field_name( 'title' ); ?>"
              type="text"
               value="<?php echo esc_attr( $instance['title'] ); ?>" />
         </label>
    </p>
    <?php }

function update( $new_instance, $old_instance ){
    $instance = $old_instance;
    $instance['title'] = sanitize_title( $new_instance['title'] );
    return $instance;}
}

function find_us_widget_init(){
    register_widget('Find_Us_Widget');}
	add_action('widgets_init','find_us_widget_init');

