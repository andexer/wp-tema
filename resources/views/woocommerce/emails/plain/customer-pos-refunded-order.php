<?php

/**
 * WooCommerce Template Override: emails/plain/customer-pos-refunded-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/customer-pos-refunded-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.customer-pos-refunded-order', get_defined_vars())->render();
