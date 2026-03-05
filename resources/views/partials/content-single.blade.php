<article @php(post_class('h-entry'))>
  <header>
    <flux:heading level="1" class="p-name">
      {!! $title !!}
    </flux:heading>

    @include('partials.entry-meta')
  </header>

  <div class="e-content">
    @php(the_content())
  </div>

  @if ($pagination())
    <footer>
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    </footer>
  @endif

  @php(comments_template())
</article>