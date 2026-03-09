<?php

/**
 * WooCommerce Template Override: emails/block/admin-failed-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/block/admin-failed-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.block.admin-failed-order', get_defined_vars())->render();
