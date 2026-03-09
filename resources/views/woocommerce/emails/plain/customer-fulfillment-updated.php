<?php

/**
 * WooCommerce Template Override: emails/plain/customer-fulfillment-updated.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/customer-fulfillment-updated.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.customer-fulfillment-updated', get_defined_vars())->render();
