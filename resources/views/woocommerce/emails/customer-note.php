<?php

/**
 * WooCommerce Template Override: emails/customer-note.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/customer-note.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.customer-note', get_defined_vars())->render();
