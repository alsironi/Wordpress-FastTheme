<?php
get_header();
?>

<?php
if ( have_posts() ) {
?>

	<header class="page-header">
		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'sk' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
	</header><!-- .page-header -->

	<?php
	/* Start the Loop */
	while ( have_posts() ){
		the_post();


	}
			
}
?>

<?php
get_sidebar();
get_footer();