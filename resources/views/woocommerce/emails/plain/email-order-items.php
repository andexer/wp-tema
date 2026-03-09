<?php

/**
 * WooCommerce Template Override: emails/plain/email-order-items.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/email-order-items.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.email-order-items', get_defined_vars())->render();
