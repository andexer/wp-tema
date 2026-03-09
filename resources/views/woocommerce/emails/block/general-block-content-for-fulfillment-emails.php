<?php

/**
 * WooCommerce Template Override: emails/block/general-block-content-for-fulfillment-emails.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see emails/block/general-block-content-for-fulfillment-emails.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.emails.block.general-block-content-for-fulfillment-emails', get_defined_vars())->render();
