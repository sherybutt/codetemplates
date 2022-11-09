/*-------------Template for specific taxonomy--------------*/

<?php
/**
*
* Template Name: Careers Position Template
*
*/

?>

<div class="heroBanner-sec positionBanner">
    <div class="wrap">
        <h1 class="head"><?php echo single_term_title(); ?></h1>
        <div class="shortDescrp"><?php echo term_description(); ?></div>
    </div>
</div>



<?php

$taxonomy = 'position'; 
$term = get_query_var( 'term' );
$term_obj = get_term_by( 'slug' , $term , $taxonomy );
                                          
                                      
$allPosts_args = array(
    'posts_per_page' => 12,
    'post_type'      => 'job',
    'paged' => get_query_var( 'paged' ),
    'tax_query' => array(
            array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => array( $term_obj->slug ),
            )
        )
);

global $wp_query;
$wp_query = new WP_Query( $allPosts_args );
?>

<div class="allPosts-container">

<?php if( $wp_query->have_posts() ) { ?>

<div class="allJobs-container">
<?php
    while( $wp_query->have_posts() ) {
        $wp_query->the_post();
?>

    <div class="singleJob-holder">
        <h2 class="innerHead"><?php the_title(); ?></h2>
        <?php 
        if($term_obj){ ?>
        <p class="jobFormat"><?php echo $term_obj->name ?></p>
        <?php } ?>
        <span class="jobLoc"><?php the_field('placeCareer'); ?></span>
        <a href="<?php the_field('bambooHrUrl'); ?>" target="_blank" class="button"><?php echo __( 'apply here', 'my-text-domain' ); ?></a>
    </div>

<?php
    }
?>

</div>
    <?php
    do_action( 'genesis_after_endwhile' );
    wp_reset_query();
    wp_reset_postdata();
}
    ?>  
</div>