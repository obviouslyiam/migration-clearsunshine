<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package anissa
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P3MLGJD');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Princess+Sofia" rel="stylesheet">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3MLGJD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'anissa' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<nav id="site-navigation" class="main-navigation clear" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'anissa' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<?php wp_nav_menu( array(
									'theme_location'  => 'social',
									'depth'           => 1,
									'link_before'     => '<span class="screen-reader-text">',
									'link_after'      => '</span>',
									'container_class' => 'social-links', ) ); ?>
			<?php endif; ?>
		</nav><!-- #site-navigation -->

		<div class="site-branding"><?php the_custom_logo(); ?>
			<?php if ( function_exists( 'jetpack_the_site_logo' ) && has_site_logo() ) : ?>
				<?php jetpack_the_site_logo(); ?>
			<?php endif; ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	<div class="wrap clear">
	<?php if ( is_home()  ) : ?>
	<div id="slider">
 
    <?php
    $carousel_cat = get_theme_mod('carousel_setting','1');
    $carousel_count = get_theme_mod('count_setting','4');
    $new_query = new WP_Query( array( 'cat' => $carousel_cat  , 'showposts' => $carousel_count ));
    while ( $new_query->have_posts() ) : $new_query->the_post(); ?>
 
    <div class="item">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'anissa-carousel-pic' ); ?></a>
         <div class="entry-dateslide">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</div><!-- .entry-datetop -->
        <h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
    </div>
 
    <?php 
        endwhile;
        wp_reset_postdata(); 
    ?>
 
	</div><!-- #slider -->

	<?php endif; ?>