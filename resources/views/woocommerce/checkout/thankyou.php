<?php

/**
 * WooCommerce Template Override: checkout/thankyou.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/thankyou.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.thankyou', get_defined_vars())->render();
