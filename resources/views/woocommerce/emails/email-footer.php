<?php

/**
 * WooCommerce Template Override: emails/email-footer.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-footer.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-footer', get_defined_vars())->render();
