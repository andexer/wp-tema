<?php

/**
 * WooCommerce Template Override: emails/customer-new-account.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-new-account.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-new-account', get_defined_vars())->render();
