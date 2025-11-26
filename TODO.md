# TODOs

- 

add_action('enqueue_block_assets', function () {

  global $post; 

  $template = get_page_template_slug($post->ID);

  wp_enqueue_style(
    $template . '-template-styles',
    get_template_directory_uri() . '/' . $template . '.css',
  ); 

});

https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/