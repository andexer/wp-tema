<?php

/**
 * WooCommerce Template Override: single-product/tabs/description.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/tabs/description.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.tabs.description', get_defined_vars())->render();
