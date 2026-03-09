<?php

/**
 * WooCommerce Template Override: emails/customer-fulfillment-updated.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-fulfillment-updated.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-fulfillment-updated', get_defined_vars())->render();
