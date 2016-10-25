<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="col-xs-12 col-sm-<?= is_active_sidebar( 'sidebar' ) ? 8 : 12 ?>">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'page' );
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					echo "<hr/>";
				endwhile;
				?>
			</div>
			<div class="col-xs-12 col-lg-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main>
	<?php get_sidebar( 'content-bottom' ); ?>
</div>
<?php get_footer(); ?>
