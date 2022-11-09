<?php
/**
 *
 * Template Name: Category Template
 *
 */

$currentTerm = get_queried_object();
									  
$allPosts_args = array(
	'posts_per_page' => 12,
	'post_type'      => 'post',
	'paged' => get_query_var( 'paged' ),
	'cat'			=> $currentTerm->term_id,
);

global $wp_query;
$wp_query = new WP_Query( $allPosts_args );

<div class="allPosts-container">

<?php if( $wp_query->have_posts() ) { ?>

<div class="postsDetails-col">
<?php
	while( $wp_query->have_posts() ) {
			$wp_query->the_post();
?>
<div class="singleItem">
	<a href="<?php echo get_the_permalink(); ?>" class="freeLink"></a>
	<div class="bottomHolder">
		<h3 class="itemHead"><?php echo get_the_title(); ?></h3>		 
		<a href="<?php echo get_the_permalink(); ?> " class="itemRead-more"><?php echo __( 'Read more', 'my-text-domain' )?></a>			
	</div>
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