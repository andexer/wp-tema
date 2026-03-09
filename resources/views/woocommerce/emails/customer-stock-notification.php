<?php

/**
 * WooCommerce Template Override: emails/customer-stock-notification.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-stock-notification.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-stock-notification', get_defined_vars())->render();
