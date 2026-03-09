<?php

/**
 * WooCommerce Template Override: emails/block/customer-invoice.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/block/customer-invoice.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.block.customer-invoice', get_defined_vars())->render();
