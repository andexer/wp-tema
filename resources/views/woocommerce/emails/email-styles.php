<?php

/**
 * WooCommerce Template Override: emails/email-styles.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-styles.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-styles', get_defined_vars())->render();
