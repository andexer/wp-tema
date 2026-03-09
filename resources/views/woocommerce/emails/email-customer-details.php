<?php

/**
 * WooCommerce Template Override: emails/email-customer-details.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-customer-details.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-customer-details', get_defined_vars())->render();
