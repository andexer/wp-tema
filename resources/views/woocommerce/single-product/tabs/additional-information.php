<?php

/**
 * WooCommerce Template Override: single-product/tabs/additional-information.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/tabs/additional-information.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.tabs.additional-information', get_defined_vars())->render();
