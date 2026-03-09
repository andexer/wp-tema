<?php

/**
 * WooCommerce Template Override: emails/plain/customer-note.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/plain/customer-note.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.plain.customer-note', get_defined_vars())->render();
