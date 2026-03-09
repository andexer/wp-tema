<?php

/**
 * WooCommerce Template Override: emails/customer-failed-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-failed-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-failed-order', get_defined_vars())->render();
