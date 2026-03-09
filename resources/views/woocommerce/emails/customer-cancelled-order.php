<?php

/**
 * WooCommerce Template Override: emails/customer-cancelled-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-cancelled-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-cancelled-order', get_defined_vars())->render();
