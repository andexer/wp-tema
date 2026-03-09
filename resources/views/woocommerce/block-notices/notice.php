<?php

/**
 * WooCommerce Template Override: block-notices/notice.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see block-notices/notice.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.block-notices.notice', get_defined_vars())->render();
