<?php

/**
 * WooCommerce Template Override: emails/plain/customer-stock-notification-verify.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/customer-stock-notification-verify.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.customer-stock-notification-verify', get_defined_vars())->render();
