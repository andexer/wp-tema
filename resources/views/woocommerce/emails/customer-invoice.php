<?php

/**
 * WooCommerce Template Override: emails/customer-invoice.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-invoice.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-invoice', get_defined_vars())->render();
