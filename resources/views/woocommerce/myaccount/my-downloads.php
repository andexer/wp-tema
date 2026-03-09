<?php

/**
 * WooCommerce Template Override: myaccount/my-downloads.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/my-downloads.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.my-downloads', get_defined_vars())->render();
