<?php

/**
 * WooCommerce Template Override: single-product/add-to-cart/variation-add-to-cart-button.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/add-to-cart/variation-add-to-cart-button.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.add-to-cart.variation-add-to-cart-button', get_defined_vars())->render();
