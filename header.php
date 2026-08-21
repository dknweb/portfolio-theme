<?php
/**
 * Theme header.
 *
 * @package PortfolioTheme
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'portfolio-theme' ); ?>
</a>

<header id="header" class="site-header">
	<div class="container">
		<div class="site-header__inner">
			<?php get_template_part( 'template-parts/global/branding' ); ?>
			
			<?php get_template_part( 'template-parts/header/navigation' ); ?>

			<?php get_template_part( 'template-parts/header/actions' ); ?>
		</div>
	</div>
</header>

