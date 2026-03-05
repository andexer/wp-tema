<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

	<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 w-full max-w-5xl mx-auto my-12" id="customer_login">

		<div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

		<?php endif; ?>

		<h2 class="text-2xl font-bold text-secondary mb-6"><?php esc_html_e('Login', 'woocommerce'); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login space-y-5" method="post" novalidate>

			<?php do_action('woocommerce_login_form_start'); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username" class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="text-red-500" aria-hidden="true">*</span><span class="sr-only"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (! empty($_POST['username']) && is_string($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine 
																																																																																		?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password" class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="text-red-500" aria-hidden="true">*</span><span class="sr-only"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
			</p>

			<?php do_action('woocommerce_login_form'); ?>

			<div class="flex items-center justify-between">
				<label class="flex items-center gap-2 cursor-pointer">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					<span class="text-sm text-gray-600"><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
				</label>
				<p class="woocommerce-LostPassword lost_password text-sm">
					<a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="text-primary hover:text-secondary transition-colors"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
				</p>
			</div>

			<div class="pt-2">
				<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
			</div>

			<?php do_action('woocommerce_login_form_end'); ?>

		</form>

		<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

		</div>

		<div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

			<h2 class="text-2xl font-bold text-secondary mb-6"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register space-y-5" <?php do_action('woocommerce_register_form_tag'); ?>>

				<?php do_action('woocommerce_register_form_start'); ?>

				<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username" class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="text-red-500" aria-hidden="true">*</span><span class="sr-only"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine 
																																																																												?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email" class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="text-red-500" aria-hidden="true">*</span><span class="sr-only"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (! empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine 
																																																																								?>
				</p>

				<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password" class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="text-red-500" aria-hidden="true">*</span><span class="sr-only"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
					</p>

				<?php else : ?>

					<p class="text-sm text-gray-600 bg-blue-50 p-4 rounded-lg border border-blue-100"><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

				<?php endif; ?>

				<?php do_action('woocommerce_register_form'); ?>

				<div class="pt-4">
					<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
				</div>

				<?php do_action('woocommerce_register_form_end'); ?>

			</form>

		</div>

	</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>