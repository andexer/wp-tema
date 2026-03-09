<?php

/**
 * WooCommerce Template Override: emails/block/customer-processing-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/block/customer-processing-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.block.customer-processing-order', get_defined_vars())->render();
