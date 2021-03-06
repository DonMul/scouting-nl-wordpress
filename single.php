<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="col-xs-12 col-sm-<?= is_active_sidebar( 'sidebar' ) ? 8 : 12 ?>">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'single' );

					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

					if ( is_singular( 'attachment' ) ) {
						the_post_navigation( array(
							'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'scouting-nl' ),
						) );
					} elseif ( is_singular( 'post' ) ) {
						the_post_navigation( array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'scouting-nl' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Next post:', 'scouting-nl' ) . '</span> ' .
								'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'scouting-nl' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Previous post:', 'scouting-nl' ) . '</span> ' .
								'<span class="post-title">%title</span>',
						) );
					}

				endwhile;
				?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>


	</main>
</div>

<?php get_footer(); ?>
