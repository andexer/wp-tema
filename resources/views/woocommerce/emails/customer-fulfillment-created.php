<?php

/**
 * WooCommerce Template Override: emails/customer-fulfillment-created.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-fulfillment-created.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-fulfillment-created', get_defined_vars())->render();
