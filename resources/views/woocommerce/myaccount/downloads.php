<?php

/**
 * WooCommerce Template Override: myaccount/downloads.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/downloads.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.downloads', get_defined_vars())->render();
