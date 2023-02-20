/* Shortcode for displaying the posts of specific term by giving slug of the term as shortcode parameter */

function display_taxonomy_post_titles($atts) {
    $atts = shortcode_atts(array(
        'taxonomy' => '',
        'term' => '',
    ), $atts);

    $args = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => $atts['taxonomy'],
                'field' => 'slug',
                'terms' => $atts['term'],
            ),
        ),
        'posts_per_page' => -1,
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        $output = '<ul>';

        while ( $query->have_posts() ) {
            $query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }

        $output .= '</ul>';

        wp_reset_postdata();

        return $output;
    }

    return 'No posts found';
}

add_shortcode( 'taxonomy_posts', 'display_taxonomy_post_titles' );




[taxonomy_posts taxonomy="my_taxonomy" term="my_term_slug"]