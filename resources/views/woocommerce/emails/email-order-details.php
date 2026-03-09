<?php

/**
 * WooCommerce Template Override: emails/email-order-details.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-order-details.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-order-details', get_defined_vars())->render();
