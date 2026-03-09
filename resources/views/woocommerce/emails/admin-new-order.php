<?php

/**
 * WooCommerce Template Override: emails/admin-new-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/admin-new-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.admin-new-order', get_defined_vars())->render();
