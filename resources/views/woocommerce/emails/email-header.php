<?php

/**
 * WooCommerce Template Override: emails/email-header.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-header.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-header', get_defined_vars())->render();
