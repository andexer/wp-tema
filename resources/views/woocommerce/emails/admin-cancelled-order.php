<?php

/**
 * WooCommerce Template Override: emails/admin-cancelled-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/admin-cancelled-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.admin-cancelled-order', get_defined_vars())->render();
