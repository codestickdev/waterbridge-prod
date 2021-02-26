<?php

/**
 * Waterbridge functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Waterbridge
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('waterbridge_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function waterbridge_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Waterbridge, use a find and replace
		 * to change 'waterbridge' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('waterbridge', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Header', 'waterbridge'),
			)
		);
		register_nav_menus(
			array(
				'menu-2' => esc_html__('Footer', 'waterbridge'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'waterbridge_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'waterbridge_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function waterbridge_content_width()
{
	$GLOBALS['content_width'] = apply_filters('waterbridge_content_width', 640);
}
add_action('after_setup_theme', 'waterbridge_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function waterbridge_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'waterbridge'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'waterbridge'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'waterbridge_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function waterbridge_scripts()
{
	wp_enqueue_style('waterbridge-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('waterbridge-style', 'rtl', 'replace');

	wp_enqueue_script('waterbridge-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'waterbridge_scripts');

wp_enqueue_style('custom_style',  get_stylesheet_directory_uri() . '/css/custom.css');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* ACF RELATIONSHIPS */
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('acf-relationship-multisite/acf-relationship-multisite.php');
}

/* ACF JSON */

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}

/* LOGIN FORM */

function wb_login_form($args = array())
{
	$defaults = array(
		'echo'           => true,
		// Default 'redirect' value takes the user back to the request URI.
		'redirect'       => 'http://waterbridge.pl/?loginStatus=success',
		'form_id'        => 'loginform',
		'label_username' => __('Adres e-mail'),
		'label_password' => __('Hasło'),
		'label_remember' => __('Zapamiętaj mnie'),
		'label_log_in'   => __('Zaloguj się'),
		'id_username'    => 'user_login',
		'id_password'    => 'user_pass',
		'id_remember'    => 'rememberme',
		'id_submit'      => 'wp-submit',
		'remember'       => true,
		'value_username' => '',
		// Set 'value_remember' to true to default the "Remember me" checkbox to checked.
		'value_remember' => false,
	);

	/**
	 * Filters the default login form output arguments.
	 *
	 * @since 3.0.0
	 *
	 * @see wp_login_form()
	 *
	 * @param array $defaults An array of default login form arguments.
	 */
	$args = wp_parse_args($args, apply_filters('login_form_defaults', $defaults));

	/**
	 * Filters content to display at the top of the login form.
	 *
	 * The filter evaluates just following the opening form tag element.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_top = apply_filters('login_form_top', '', $args);

	/**
	 * Filters content to display in the middle of the login form.
	 *
	 * The filter evaluates just following the location where the 'login-password'
	 * field is displayed.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_middle = apply_filters('login_form_middle', '', $args);

	/**
	 * Filters content to display at the bottom of the login form.
	 *
	 * The filter evaluates just preceding the closing form tag element.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_bottom = apply_filters('login_form_bottom', '', $args);

	$form = '
        <form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url(site_url('wp-login.php', 'login_post')) . '" method="post">
            ' . $login_form_top . '
            <p class="login-username inputWrap">
                <input type="text" name="log" placeholder="' . esc_html($args['label_username']) . '" id="' . esc_attr($args['id_username']) . '" class="input" value="' . esc_attr($args['value_username']) . '" size="20" />
            </p>
            <p class="login-password inputWrap">
                <input type="password" name="pwd" placeholder="' . esc_html($args['label_password']) . '" id="' . esc_attr($args['id_password']) . '" class="input" value="" size="20" />
            </p>
			<div class="actionFields">
            ' . $login_form_middle . '
            ' . ($args['remember'] ? '<p class="login-remember formCheckbox"><label class=""><input name="rememberme" type="checkbox" id="' . esc_attr($args['id_remember']) . '" value="forever"' . ($args['value_remember'] ? ' checked="checked"' : '') . ' /> ' . esc_html($args['label_remember']) . '</label></p>' : '') . '
			<p class="forgot-pass"><a><span>Przypomnij mi hasło</span></a></p>
			</div>
			<p class="login-submit">
                <input type="submit" name="wp-submit" id="' . esc_attr($args['id_submit']) . '" class="btn" value="' . esc_attr($args['label_log_in']) . '" />
                <input type="hidden" name="redirect_to" value="' . esc_url($args['redirect']) . '" />
            </p>
            ' . $login_form_bottom . '
        </form>';

	if ($args['echo']) {
		echo $form;
	} else {
		return $form;
	}
}
add_action( 'wp_login_failed', 'my_front_end_login_fail' ); 

function my_front_end_login_fail( $username ) {
   $referrer = home_url();

   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?loginStatus=failed' );
      exit;
   }
}

/* EXTRA USER FIELDS
---------------------- */

/**
 * The field on the editing screens.
 *
 * @param $user WP_User user object
 */
function wporg_usermeta_form_field_phone($user)
{
?>
	<h3>Dane osobiste</h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="user_phone">Numer telefonu</label>
			</th>
			<td>
				<input type="tel" class="regular-text ltr" id="user_phone" name="user_phone" value="<?= esc_attr(get_user_meta($user->ID, 'user_phone', true)) ?>" placeholder="Numer telefonu" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_pesel">Numer PESEL</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" minlength="11" maxlength="11" id="user_pesel" name="user_pesel" value="<?= esc_attr(get_user_meta($user->ID, 'user_pesel', true)) ?>" placeholder="Numer PESEL" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_birthday">Data urodzenia</label>
			</th>
			<td>
				<input type="text"
                       class="regular-text ltr"
                       id="user_birthday"
                       name="user_birthday"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'user_birthday', true ) ) ?>"
                       title="Proszę uzyć formatu YYYY-MM-DD"
                       pattern="(3[01]|[21][0-9]|0[1-9])-(1[0-2]|0[1-9])-(19[0-9][0-9]|20[0-9][0-9])"
                       required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_bank">Adres korespondencyjny</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" id="user_street" name="user_street" value="<?= esc_attr( get_user_meta( $user->ID, 'user_street', true ) ) ?>" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_bank">Numer konta bankowego</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" minlength="26" maxlength="26" id="user_bank" name="user_bank" value="<?= esc_attr( get_user_meta( $user->ID, 'user_bank', true ) ) ?>" required>
			</td>
		</tr>
	</table>
<?php
}

/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function wporg_usermeta_form_field_phone_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_phone', $_POST['user_phone']);
}
function wporg_usermeta_form_field_pesel_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_pesel', $_POST['user_pesel']);
}
function wporg_usermeta_form_field_birthday_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_birthday', $_POST['user_birthday']);
}
function wporg_usermeta_form_field_street_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_street', $_POST['user_street']);
}
function wporg_usermeta_form_field_bank_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_bank', $_POST['user_bank']);
}

// Add the field to user's own profile editing screen.
add_action('show_user_profile', 'wporg_usermeta_form_field_phone');

// Add the field to user profile editing screen.
add_action('edit_user_profile', 'wporg_usermeta_form_field_phone');

// Add the save action to user's own profile editing screen update.
add_action('personal_options_update', 'wporg_usermeta_form_field_phone_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_pesel_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_birthday_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_street_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_bank_update');

// Add the save action to user profile editing screen update.
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_phone_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_pesel_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_birthday_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_street_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_bank_update');

/* REGISTER FORM */

add_action('init', 'create_account');
function create_account(){

	//You may need some data validation here
	$name = (isset($_POST['registerName']) ? $_POST['registerName'] : '');
	$surname = (isset($_POST['registerSurname']) ? $_POST['registerSurname'] : '');
	$phone = (isset($_POST['registerPhone']) ? $_POST['registerPhone'] : '');
	$email = (isset($_POST['registerEmail']) ? $_POST['registerEmail'] : '');
	$pass = (isset($_POST['registerPass']) ? $_POST['registerPass'] : '');
	$login = $name . $surname;

	if ( !email_exists($email) ) {
		$userCreate = wp_create_user($login, $pass, $email);
		if (!is_wp_error($userCreate)) {
			//user has been created
			$user = new WP_User($userCreate);
			$user->set_role('inwestor');

			wp_redirect(home_url());
			exit;
		}
	}else{
		echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#wbPopup").addClass("toggle");
			$(".wbPopup__register").addClass("active");
			setTimeout(function(){
				$(".wbPopup__register").addClass("toggle");
			}, 300);
			$(".registerForm").addClass("registerForm--errorEmail");
		});
		</script>';
	}
}
add_action('user_register', 'waterbridge_user_register');
function waterbridge_user_register($user_id){

	if (!empty($_POST['registerName'])) {
		update_user_meta($user_id, 'first_name', trim($_POST['registerName']));
	}
	if (!empty($_POST['registerSurname'])) {
		update_user_meta($user_id, 'last_name', trim($_POST['registerSurname']));
	}
	if (!empty($_POST['registerPhone'])) {
		update_user_meta($user_id, 'user_phone', trim($_POST['registerPhone']));
	}
}
function auto_login_new_user( $user_id ) {
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
	switch_to_blog(2);
    wp_redirect( home_url( '/?registerStatus=success' ) );
	switch_to_blog(1);
    exit();
}
add_action( 'user_register', 'auto_login_new_user' );

add_action('after_setup_theme', 'remove_admin_bar');
	function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

/**
 * Custom register email
 */
add_filter( 'wp_new_user_notification_email', 'custom_wp_new_user_notification_email', 10, 3 );
function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
 
    $user_login = stripslashes( $user->user_login );
    $user_email = stripslashes( $user->user_email );
    $login_url  = home_url('?loginStatus=noLogged');
    $message  = __( 'Hi there,' ) . "/r/n/r/n";
    $message .= sprintf( __( "Welcome to %s! Here's how to log in:" ), get_option('blogname') ) . "/r/n/r/n";
    $message .= $login_url . "/r/n";
    $message .= sprintf( __('Username: %s'), $user_login ) . "/r/n";
    $message .= sprintf( __('Email: %s'), $user_email ) . "/r/n";
    $message .= __( 'Password: The one you entered in the registration form. (For security reason, we save encripted password)' ) . "/r/n/r/n";
    $message .= sprintf( __('If you have any problems, please contact me at %s.'), get_option('admin_email') ) . "/r/n/r/n";
    $message .= __( 'bye!' );
 
    $wp_new_user_notification_email['subject'] = sprintf( '[%s] Your credentials.', $blogname );
    $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
    $wp_new_user_notification_email['message'] = $message;
 
    return $wp_new_user_notification_email;
}

// Create the custom pages at plugin activation

register_activation_hook( __FILE__, 'dgm_plugin_activated' );
function dgm_plugin_activated() {
	// Information needed for creating the plugin's pages
	$page_definitions = array(
		'member-password-lost' => array(
			'title' => __( 'Forgot Your Password?', 'personalize-login' ),
			'content' => '[custom-password-lost-form]'
		),
		'member-password-reset' => array(
			'title' => __( 'Pick a New Password', 'personalize-login' ),
			'content' => '[custom-password-reset-form]'
		)
	);

	foreach ( $page_definitions as $slug => $page ) {
		// Check that the page doesn't exist already
		$query = new WP_Query( 'pagename=' . $slug );
		if ( ! $query->have_posts() ) {
			// Add the page using the data from the array above
			wp_insert_post(
				array(
					'post_content'   => $page['content'],
					'post_name'      => $slug,
					'post_title'     => $page['title'],
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'ping_status'    => 'closed',
					'comment_status' => 'closed',
				)
			);
		}
	}
}

add_action('login_form_lostpassword', 'redirect_to_custom_lostpassword');
function redirect_to_custom_lostpassword() {
	if ('GET' == $_SERVER['REQUEST_METHOD']) {
		if (is_user_logged_in()) {
			$this->redirect_logged_in_user();
			exit;
		}
		wp_redirect(home_url(''));//page slug where reset shortcode will be use
		exit;
	}
}

add_shortcode('custom-password-lost-form', 'render_password_lost_form');
function render_password_lost_form($attributes, $content = null) {
	// Parse shortcode attributes
	$default_attributes = array('show_title' => false);
	$attributes = shortcode_atts($default_attributes, $attributes);


	if (is_user_logged_in()) {
		return ?><p class="errorTable"><?php __('Aby móc zmienić hasło musisz się wylogować', 'personalize-login'); ?></p>
		<?php
	} else {
		if ( isset( $_REQUEST['errors'] ) ) {
			switch($_REQUEST['errors']){
				case 'empty_username': ?>
					<p class="errorTable"><?php _e( 'Musisz wpisać adres e-mail aby móc kontynuować.', 'personalize-login' ); ?></p>
			<?php
				case 'invalid_email':
				case 'invalidcombo':?>
					<p class="errorTable"><?php _e( 'Nie znaleziono uzytkowników z podanym adresem e-mail.', 'personalize-login' ); ?></p>
			<?php }
		}
		if ( isset( $_REQUEST['checkemail'] ) ) {
			switch($_REQUEST['checkemail']){
				case 'confirm':?>
					<p class="errorTable success"><?php _e( 'Na podany adres e-mail został wysłany link do zmiany hasła.', 'personalize-login' ); ?></p>
			<?php }
//			return;
		}
		if ( isset( $_POST['user_login'] ) ) {
			var_dump($_POST['user_login']);
		}
//		$link = get_the_permalink();
		//var_dump($link);
		?>
		<div id="password-lost-form" class="widecolumn">
			<p class="toChange"><?php _e( "Jeśli nie pamiętasz adresu e-mail<br/>skontaktuj się z naszym działem obsługi klienta <a href='mailto:bok@waterbridge.pl'>bok@waterbridge.pl</a>", 'personalize_login' ); ?></p>
			<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
				<p class="form-row">
						<input type="text" name="user_login" id="user_login" class="input" placeholder="Adres e-mail">
				</p>
				<p class="lostpassword-submit">
					<input type="submit" name="submit" class="lostpassword-button btn"
					       value="<?php _e('Przypomnij', 'personalize-login'); ?>"/>
				</p>
			</form>
		</div>
		<?php
	}
}

add_action('login_form_lostpassword', 'do_password_lost');
function do_password_lost() {
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		$errors = retrieve_password();
		if (is_wp_error($errors)) {
			// Errors found
			$redirect_url = home_url();//page slug where reset shortcode will be use
			$redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);
		} else {
			// Email sent
//			$link = get_the_permalink();
//			var_dump($link);
//			$redirect_url = home_url('signin');
			$redirect_url = home_url();//page slug where reset shortcode will be use
			$redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
		}

		wp_redirect($redirect_url);
		exit;
	}
}

//After send Email
add_action('login_form_rp', 'redirect_to_custom_password_reset');
add_action('login_form_resetpass', 'redirect_to_custom_password_reset');
function redirect_to_custom_password_reset() {
	if ('GET' == $_SERVER['REQUEST_METHOD']) {
		// Verify key / login combo
		$user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(home_url('member-login?login=expiredkey'));
			} else {
				wp_redirect(home_url('member-login?login=invalidkey'));
			}
			exit;
		}

		$redirect_url = home_url();
		$redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
		$redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);

		wp_redirect($redirect_url);
		exit;
	}
}


add_shortcode('custom-password-reset-form', 'render_password_reset_form');
function render_password_reset_form($attributes, $content = null) {
	// Parse shortcode attributes
	$default_attributes = array('show_title' => false);
	$attributes = shortcode_atts($default_attributes, $attributes);

	if (is_user_logged_in()) {
		return __('You are already signed in.', 'personalize-login');
	} else {
		if (isset($_REQUEST['login']) && isset($_REQUEST['key'])) {
			$attributes['login'] = $_REQUEST['login'];
			$attributes['key'] = $_REQUEST['key'];

			// Error messages
			$errors = array();
			if (isset($_REQUEST['error'])) {
				$error_codes = explode(',', $_REQUEST['error']);

				foreach ($error_codes as $code) {
					$errors [] = $this->get_error_message($code);
				}
			}
			$attributes['errors'] = $errors;
			?>
			<div id="password-reset-form" class="widecolumn">
				<form name="resetpassform" id="resetpassform"
				      action="<?php echo site_url('wp-login.php?action=resetpass'); ?>" method="post" autocomplete="off">
					<input type="hidden" id="user_login" name="rp_login"
					       value="<?php echo esc_attr($attributes['login']); ?>" autocomplete="off"/>
					<input type="hidden" name="rp_key" value="<?php echo esc_attr($attributes['key']); ?>"/>

					<?php if (count($attributes['errors']) > 0) : ?>
						<?php foreach ($attributes['errors'] as $error) : ?>
							<p>
								<?php echo $error; ?>
							</p>
						<?php endforeach; ?>
					<?php endif; ?>
					<p>
						<input type="password" name="pass1" id="pass1" class="input" size="20" placeholder="Nowe hasło" value="" autocomplete="off"/>
					</p>
					<p>
						<input type="password" name="pass2" id="pass2" class="input" size="20" value="" placeholder="Powtórz nowe hasło" autocomplete="off"/>
					</p>
					<p class="resetpass-submit" style="text-align: center; margin: 0;">
						<input type="submit" name="submit" id="resetpass-button" class="button btn" value="Zmień hasło"/>
					</p>
				</form>
			</div>
			<?php
		} else {
			return __('Invalid password reset link.', 'personalize-login');
		}
	}
}

add_action('login_form_rp', 'do_password_reset');
add_action('login_form_resetpass', 'do_password_reset');
function do_password_reset() {
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		$rp_key = $_REQUEST['rp_key'];
		$rp_login = $_REQUEST['rp_login'];

		$user = check_password_reset_key($rp_key, $rp_login);

		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(home_url('signin?login=expiredkey'));
			} else {
				wp_redirect(home_url('signin?login=invalidkey'));
			}
			exit;
		}

		if (isset($_POST['pass1'])) {
			if ($_POST['pass1'] != $_POST['pass2']) {
				// Passwords don't match
				$redirect_url = home_url();

				$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
				$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
				$redirect_url = add_query_arg('errors', 'password_reset_mismatch', $redirect_url);

				wp_redirect($redirect_url);
				exit;
			}

			if (empty($_POST['pass1'])) {
				// Password is empty
				$redirect_url = home_url();

				$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
				$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
				$redirect_url = add_query_arg('errors', 'password_reset_empty', $redirect_url);

				wp_redirect($redirect_url);
				exit;
			}

			// Parameter checks OK, reset password
			reset_password($user, $_POST['pass1']);
			wp_redirect(home_url('?password=changed'));//page slug where signin shortcode will be use
		} else {
			echo "Invalid request.";
		}

		exit;
	}
}

remove_action( 'template_redirect', 'redirect_canonical' );