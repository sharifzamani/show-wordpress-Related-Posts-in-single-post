<?php
// Get the categories of the current post
$post_categories = wp_get_post_categories( get_the_ID() );

// Set up the query arguments for related posts
$args = array(
    'category__in' => $post_categories,
    'post__not_in' => array( get_the_ID() ),
    'posts_per_page' => 3,
    'orderby' => 'rand',
);

// Run the query for related posts
$related_posts_query = new WP_Query( $args );

// If there are related posts, display them
if ( $related_posts_query->have_posts() ) {
    echo '<div class="related-posts">';
    echo '<h3>Related Posts</h3>';
    echo '<ul>';
    while ( $related_posts_query->have_posts() ) {
        $related_posts_query->the_post();
        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
    }
    echo '</ul>';
    echo '</div>';
}

// Reset the post data
wp_reset_postdata();
?>
