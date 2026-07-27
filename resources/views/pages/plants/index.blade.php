@extends('layouts.app')

@section('title', 'Plant Nursery Catalog | Verdura Landscapes')
@push('styles')
    <!-- Tailwind CSS (CDN for standalone usage; remove if compiled in style.css) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endpush
@push('scripts')
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Model Viewer for Interactive 3D Web Rendering -->
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
@endpush
@section('content')
<section style="padding: 80px 0;">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Nursery Catalog</span>
        <h2>Our Full Plant Collection</h2>
      </div>
      <p>Quality landscape plants cultivated and selected for Kenya’s climate conditions.</p>
    </div>

    <!-- Search Form -->
    <form action="{{ route('plants.index') }}" method="GET" style="margin-bottom: 40px; max-width: 540px;">
      <div style="display: flex; gap: 10px;">
        <div style="position: relative; flex: 1; display: flex; align-items: center;">
          <svg style="position: absolute; left: 16px; width: 20px; height: 20px; color: #7a7a6e; pointer-events: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Search all plants by name or botanical name..." 
            style="width: 100%; padding: 12px 16px 12px 48px; background: var(--stone-light); border: 1px solid rgba(26,26,22,0.15); border-radius: 2px; font-family: inherit; font-size: 0.95rem; color: var(--ink); outline: none;"
          />
        </div>

        <button 
          type="submit" 
          style="background: var(--forest); color: var(--stone-light); border: none; padding: 12px 22px; font-weight: 600; font-size: 0.9rem; border-radius: 2px; cursor: pointer; transition: background 0.2s;"
          onmouseover="this.style.background='var(--forest-deep)'"
          onmouseout="this.style.background='var(--forest)'"
        >
          Search
        </button>

        @if(request()->filled('search'))
          <a 
            href="{{ route('plants.index') }}" 
            style="background: transparent; color: var(--clay); border: 1px solid var(--clay); padding: 12px 16px; font-weight: 600; font-size: 0.9rem; border-radius: 2px; text-decoration: none; display: inline-flex; align-items: center;"
          >
            Clear
          </a>
        @endif
      </div>
    </form>

    @php $hasResults = false; @endphp

    @foreach(['featured' => 'Featured Picks', 'tree' => 'Trees', 'shrub' => 'Shrubs', 'groundcover' => 'Groundcovers'] as $categoryKey => $categoryTitle)
      @if(isset($plants[$categoryKey]) && $plants[$categoryKey]->count() > 0)
        @php $hasResults = true; @endphp
        <div style="margin-bottom: 50px;">
          <h2 style="color: var(--forest); margin-bottom: 24px; font-family: 'Fraunces', serif;">
            {{ $categoryTitle }}
          </h2>
          <div class="catalog-grid">
            @foreach($plants[$categoryKey] as $plant)
              <x-plant-card :plant="$plant" />
            @endforeach
          </div>
        </div>
      @endif
    @endforeach

    @if(!$hasResults)
      <div style="padding: 20px 0; color: #55554c;">
        @if(request()->filled('search'))
          <p>No plants matching "<strong>{{ request('search') }}</strong>" found across any category.</p>
        @else
          <p>No plants currently available in the catalog.</p>
        @endif
      </div>
    @endif
  </div>
</section>
@endsection