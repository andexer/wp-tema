<?php

/**
 * WooCommerce Template Override: emails/email-mobile-messaging.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/email-mobile-messaging.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.email-mobile-messaging', get_defined_vars())->render();
