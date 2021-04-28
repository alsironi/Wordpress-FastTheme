<?php
get_header();

while( have_posts() ){
the_post();
?>

<!-- Sección para el artículo -->
<section id="view-article">

    <!-- Artículo -->
    <article class="article">

		<?php
		$featured_image = get_the_post_thumbnail_url();
		if($featured_image){
			echo '<figure><img src="'.$featured_image.'"></figure>';
		}

		the_content();
		?>

    </article>

    <div class="sidebar">
        <img src="http://placehold.it/300x200" style="width: 100%;">
    </div>

</section>

<?php
}

get_footer();