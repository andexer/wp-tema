<?php

/**
 * WooCommerce Template Override: checkout/review-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/review-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.review-order', get_defined_vars())->render();
