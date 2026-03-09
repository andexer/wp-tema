<?php

/**
 * Login Form Override
 * 
 * Este archivo sirve como puente para que WooCommerce detecte el override,
 * pero delega el renderizado real a la plantilla Blade con componentes Flux.
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Renderizamos la vista Blade personalizada que creamos anteriormente
echo view('woocommerce.myaccount.form-login', get_defined_vars())->render();
