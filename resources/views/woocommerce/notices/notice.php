<?php

/**
 * WooCommerce Template Override: notices/notice.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see notices/notice.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.notices.notice', get_defined_vars())->render();
