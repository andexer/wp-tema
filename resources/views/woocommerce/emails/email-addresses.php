<?php

/**
 * WooCommerce Template Override: emails/email-addresses.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-addresses.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-addresses', get_defined_vars())->render();
