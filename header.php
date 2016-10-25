<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<img class="header-image" src="<?php header_image(); ?>"/>
		<?php if ( has_nav_menu( 'primary' )): ?>
			<?php create_bootstrap_menu('primary'); ?>
		<?php endif; ?>
	</div>
</div>
	<div id="main" class="container">
		<div id="content" class="site-content">
