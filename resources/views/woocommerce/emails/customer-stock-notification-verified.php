<?php

/**
 * WooCommerce Template Override: emails/customer-stock-notification-verified.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-stock-notification-verified.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-stock-notification-verified', get_defined_vars())->render();
