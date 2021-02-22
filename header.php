<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Waterbridge
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="/wp-content/themes/waterbridge-prod/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/waterbridge-prod/plugins/slick/slick.css"/>
	
	<?php wp_head(); ?>
</head>
<?php
	$currentUserID = get_current_user_id();
	$user_info = get_userdata($currentUserID);
?>
<body <?php body_class(); ?> username="<?php echo $user_info->first_name . ' ' . $user_info->last_name; ?>" logout="<?php echo wp_logout_url( home_url() ); ?>">
<div id="userBase" style="display: none !important;">
	<?php
		$current_user = wp_get_current_user();
		$current_user_id = 'user_' . $current_user->ID;
	?>
	<?php if (have_rows('user_investment', $current_user_id)) : ?>
		<?php while (have_rows('user_investment', $current_user_id)) : the_row();
			$investments = get_sub_field('user_investment_name');
			$investmentID = $investments['selected_posts'][0];
			$value = get_sub_field('user_investment_value');
			
			echo $investmentID;

			endwhile; ?>
	<?php endif; ?>
</div>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'waterbridge' ); ?></a>

	<header id="masthead" class="siteHeader <?php if ( is_front_page() ) : ?>siteHeader--frontPage <?php else: ?>siteHeader--subpage <?php endif; ?>container">
		<div class="siteHeader__logo">
			<a href="<?php echo home_url(); ?>" rel="home" class="logo_dark"><img src="/wp-content/themes/waterbridge-prod/images/logo.svg"/></a>
			<a href="<?php echo home_url(); ?>" rel="home" class="logo_white"><img src="/wp-content/themes/waterbridge-prod/images/logo_white.svg"/></a>
		</div>
		<nav id="site-navigation" class="main-navigation siteHeader__menu">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav>
	</header>
