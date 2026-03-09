<?php

/**
 * WooCommerce Template Override: emails/customer-reset-password.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-reset-password.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-reset-password', get_defined_vars())->render();
