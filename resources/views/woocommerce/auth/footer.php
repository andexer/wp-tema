<?php

/**
 * WooCommerce Template Override: auth/footer.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see auth/footer.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.auth.footer', get_defined_vars())->render();
