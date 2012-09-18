<?php
//Register Sidebars

// http://codex.wordpress.org/Function_Reference/register_sidebar
function cur_register_listed_sidebars() {
  $sidebars = array('Blog', 'Contact' );

  foreach($sidebars as $sidebar) {
    register_sidebar(
      array(
        'id'            => 'cur-' . sanitize_title($sidebar),
        'name'          => $sidebar,
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
      )
    );
    
  }
}

add_action('widgets_init', 'cur_register_listed_sidebars');
