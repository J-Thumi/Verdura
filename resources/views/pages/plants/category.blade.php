@extends('layouts.app')

@section('title', $title . ' Catalog | Verdura Landscapes')

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
        <span class="eyebrow">Category Catalog</span>
        <h2>{{ $title }}</h2>
      </div>
      <p>Carefully nurtured {{ strtolower($title) }} ready for delivery across Kenya.</p>
    </div>

    <!-- Search & Sort Controls Form -->
    <form action="{{ request()->url() }}" method="GET" style="margin-bottom: 40px;">
      <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
        
        <!-- Search Field & Submit Button -->
        <div style="display: flex; gap: 10px; flex: 1; min-width: 300px; max-width: 540px;">
          <div style="position: relative; flex: 1; display: flex; align-items: center;">
            <svg style="position: absolute; left: 16px; width: 20px; height: 20px; color: #7a7a6e; pointer-events: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input 
              type="text" 
              name="search"
              value="{{ request('search') }}"
              placeholder="Search {{ strtolower($title) }}..." 
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
        </div>

        <!-- Sort Dropdown & Reset Action -->
        <div style="display: flex; gap: 10px; align-items: center;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <label for="sort" style="font-size: 0.88rem; font-weight: 600; color: #55554c; whitespace: nowrap;">Sort by:</label>
            <select 
              name="sort" 
              id="sort"
              onchange="this.form.submit()"
              style="padding: 12px 16px; background: var(--stone-light); border: 1px solid rgba(26,26,22,0.15); border-radius: 2px; font-family: inherit; font-size: 0.9rem; color: var(--ink); cursor: pointer; outline: none;"
            >
              <option value="default" {{ request('sort', 'default') === 'default' ? 'selected' : '' }}>Default Order</option>
              <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name (A to Z)</option>
              <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name (Z to A)</option>
              <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
              <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
              <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Newest Arrival</option>
            </select>
          </div>

          @if(request()->filled('search') || (request()->filled('sort') && request('sort') !== 'default'))
            <a 
              href="{{ request()->url() }}" 
              style="background: transparent; color: var(--clay); border: 1px solid var(--clay); padding: 12px 16px; font-weight: 600; font-size: 0.9rem; border-radius: 2px; text-decoration: none; display: inline-flex; align-items: center;"
            >
              Reset Filters
            </a>
          @endif
        </div>

      </div>
    </form>

    @if($plants->count() > 0)
      <div class="catalog-grid">
        @foreach($plants as $plant)
          <x-plant-card :plant="$plant" />
        @endforeach
      </div>

      <!-- Pagination Links -->
      <div style="margin-top: 48px;">
        {{ $plants->links() }}
      </div>
    @else
      <div style="padding: 20px 0; color: #55554c;">
        @if(request()->filled('search'))
          <p>No {{ strtolower($title) }} matching "<strong>{{ request('search') }}</strong>" found.</p>
        @else
          <p>No {{ strtolower($title) }} currently available in the catalog.</p>
        @endif
      </div>
    @endif
  </div>
</section>
@endsection