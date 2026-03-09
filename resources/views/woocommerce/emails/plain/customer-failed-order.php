<?php

/**
 * WooCommerce Template Override: emails/plain/customer-failed-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/customer-failed-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.customer-failed-order', get_defined_vars())->render();
