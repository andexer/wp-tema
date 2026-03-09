<?php

/**
 * WooCommerce Template Override: emails/block/default-block-content.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/block/default-block-content.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.block.default-block-content', get_defined_vars())->render();
