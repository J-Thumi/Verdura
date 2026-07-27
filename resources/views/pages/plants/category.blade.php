@extends('layouts.app')

@section('title', $title . ' Catalog | Verdura Landscapes')

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

    <!-- Search Form with Submit Button -->
    <form action="{{ request()->url() }}" method="GET" style="margin-bottom: 40px; max-width: 540px;">
      <div style="display: flex; gap: 10px;">
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

        @if(request()->filled('search'))
          <a 
            href="{{ request()->url() }}" 
            style="background: transparent; color: var(--clay); border: 1px solid var(--clay); padding: 12px 16px; font-weight: 600; font-size: 0.9rem; border-radius: 2px; text-decoration: none; display: inline-flex; align-items: center;"
          >
            Clear
          </a>
        @endif
      </div>
    </form>

    @if($plants->count() > 0)
      <div class="catalog-grid">
        @foreach($plants as $plant)
          <x-plant-card :plant="$plant" />
        @endforeach
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