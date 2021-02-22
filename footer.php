<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Waterbridge
 */

?>

<footer class="pageFooter">
	<div class="pageFooter__wrap container">
		<div class="pageFooter__menu">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'primary-menu',
					)
				);
			?>
		</div>
		<div class="pageFooter__logo">
			<img src="/wp-content/themes/waterbridge-prod/images/logo_white.svg"/>
		</div>
		<div class="pageFooter__content">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisi lectus, tempus sed urna non, dapibus sollicitudin leo.
				Sed facilisis lacinia odio, nec commodo justo ullamcorper quis. Praesent semper nisi at dolor lobortis, ut tempus lorem maximus.
				Phasellus posuere volutpat nisi euismod feugiat. Donec lacus mauris, semper eu eros non, blandit interdum dui.
				Suspendisse eu imperdiet tortor. Etiam non lorem a velit commodo tristique.
				Vestibulum tempus nibh quam, nec commodo massa posuere at.</p>
			<p>Suspendisse finibus eros non sapien aliquam tincidunt. Curabitur venenatis non nunc ac tincidunt.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed facilisis nisi. Etiam luctus elit ac maximus tempus.
				Sed dapibus enim nec pretium maximus. Etiam id mi eget magna venenatis aliquam. Nunc tincidunt eros in nunc feugiat varius.
				Integer vestibulum et nisl lacinia feugiat. Vestibulum in massa pellentesque, finibus urna sit amet, molestie nisl.
				Maecenas at commodo lorem. Nunc non felis imperdiet, auctor arcu et, scelerisque augue. Suspendisse dapibus tortor ut varius tincidunt.
				Pellentesque quis ex porta, tristique mi eu, venenatis lacus. Ut in dolor a lorem ultricies feugiat et a lectus.
				Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
		</div>
	</div>
</footer>
<div id="wbPopup" class="wbPopup">
	<div class="wbPopup__wrap">
		<?php //echo do_shortcode('[custom-password-lost-form]') ?>
		<div class="wbPopup__close">
			<img src="/wp-content/themes/waterbridge-prod/images/icons/close_ico.svg"/>
		</div>
		<div class="popupFormContent wbPopup__login wbLogin">
			<?php include get_template_directory() . '/template-parts/_loginForm.php'; ?>
		</div>
		<div class="popupFormContent wbPopup__register wbRegister">
			<?php include get_template_directory() . '/template-parts/_registerForm.php'; ?>
		</div>
		<div class="popupFormContent wbPopup__passLost wbPassLost">
			<?php include get_template_directory() . '/template-parts/_passLost.php'; ?>
		</div>
		<div class="popupFormContent wbPopup__newPass wbNewPass">
			<?php include get_template_directory() . '/template-parts/_newPass.php'; ?>
		</div>
	</div>
</div>
<div id="pageLoader" class="pageLoader">
	<div class="pageLoader__wrap">
		<img src="/wp-content/themes/waterbridge-prod/images/logo_white.svg"/>
	</div>
</div>
</div><!-- #page -->

	<?php wp_footer(); ?>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/wp-content/themes/waterbridge-prod/js/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="/wp-content/themes/waterbridge-prod/js/jquery-number.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="/wp-content/themes/waterbridge-prod/js/custom.js"></script>
	<script type="text/javascript" src="/wp-content/themes/waterbridge-prod/plugins/slick/slick.min.js"></script>
</body>
</html>
