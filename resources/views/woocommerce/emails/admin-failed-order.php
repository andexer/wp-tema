<?php

/**
 * WooCommerce Template Override: emails/admin-failed-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/admin-failed-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.admin-failed-order', get_defined_vars())->render();
