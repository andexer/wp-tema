<?php

/**
 * WooCommerce Template Override: myaccount/lost-password-confirmation.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/lost-password-confirmation.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.lost-password-confirmation', get_defined_vars())->render();
