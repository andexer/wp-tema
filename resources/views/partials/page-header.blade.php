@if (! (function_exists('is_cart') && (is_cart() || is_checkout() || is_account_page())))
  <div class="page-header">
    <flux:heading level="1">{!! $title !!}</flux:heading>
  </div>
@endif
