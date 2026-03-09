@extends('layouts.app')

@section('content')
  @php
    /**
     * WooCommerce Archive Product Template
     * Rendered through Sage's Blade layout for proper header/footer/assets.
     * @version 8.6.0
     */
    defined('ABSPATH') || exit;
  @endphp

  <div class="woocommerce max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    @php
    /**
     * Hook: woocommerce_before_main_content.
     * @hooked woocommerce_output_content_wrapper - 10
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action('woocommerce_before_main_content');
    @endphp

    @php
    /**
     * Hook: woocommerce_shop_loop_header.
     * @since 8.6.0
     * @hooked woocommerce_product_taxonomy_archive_header - 10
     */
    do_action('woocommerce_shop_loop_header');
    @endphp

    @if(woocommerce_product_loop())
      @php
      /**
       * Hook: woocommerce_before_shop_loop.
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */
      do_action('woocommerce_before_shop_loop');
      @endphp

      @php woocommerce_product_loop_start(); @endphp

      @if(wc_get_loop_prop('total'))
        @while(have_posts())
          @php
            the_post();
            do_action('woocommerce_shop_loop');
            wc_get_template_part('content', 'product');
          @endphp
        @endwhile
      @endif

      @php woocommerce_product_loop_end(); @endphp

      @php
      /**
       * Hook: woocommerce_after_shop_loop.
       * @hooked woocommerce_pagination - 10
       */
      do_action('woocommerce_after_shop_loop');
      @endphp
    @else
      @php
      /**
       * Hook: woocommerce_no_products_found.
       * @hooked wc_no_products_found - 10
       */
      do_action('woocommerce_no_products_found');
      @endphp
    @endif

    @php
    /**
     * Hook: woocommerce_after_main_content.
     * @hooked woocommerce_output_content_wrapper_end - 10
     */
    do_action('woocommerce_after_main_content');
    @endphp
  </div>
@endsection
