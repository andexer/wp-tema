<?php

/**
 * WooCommerce Template Override: emails/plain/email-customer-details.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/email-customer-details.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.email-customer-details', get_defined_vars())->render();
