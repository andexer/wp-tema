<?php

/**
 * WooCommerce Template Override: emails/plain/email-fulfillment-details.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/email-fulfillment-details.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.email-fulfillment-details', get_defined_vars())->render();
