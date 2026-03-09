<?php

/**
 * WooCommerce Template Override: emails/block/customer-on-hold-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/block/customer-on-hold-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.block.customer-on-hold-order', get_defined_vars())->render();
