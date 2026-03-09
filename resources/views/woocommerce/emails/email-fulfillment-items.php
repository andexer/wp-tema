<?php

/**
 * WooCommerce Template Override: emails/email-fulfillment-items.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-fulfillment-items.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-fulfillment-items', get_defined_vars())->render();
