<?php

/**
 * Cart Page Override
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override del carrito,
 * delegando el renderizado real a la plantilla Blade con animación SPA y componentes Flux.
 */

defined('ABSPATH') || exit;

// Renderizamos la vista Blade personalizada para el carrito
echo view('woocommerce.cart.cart')->render();
