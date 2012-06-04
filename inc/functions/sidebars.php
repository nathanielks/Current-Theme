<?php
//Register Sidebars

// http://codex.wordpress.org/Function_Reference/register_sidebar
function ds_register_listed_sidebars() {
  $sidebars = array('Sidebar', 'Footer');

  foreach($sidebars as $sidebar) {
    register_sidebar(
      array(
        'id'            => 'hu-' . sanitize_title($sidebar),
        'name'          => __($sidebar, 'hope'),
        'description'   => __($sidebar, 'hope'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
      )
    );
  }
}

add_action('widgets_init', 'ds_register_listed_sidebars');
