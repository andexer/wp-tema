<?php

/**
 * WooCommerce Template Override: emails/customer-completed-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-completed-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-completed-order', get_defined_vars())->render();
