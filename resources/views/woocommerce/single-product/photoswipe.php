<?php

/**
 * WooCommerce Template Override: single-product/photoswipe.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/photoswipe.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.photoswipe', get_defined_vars())->render();
