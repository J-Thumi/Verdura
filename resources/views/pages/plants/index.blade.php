@extends('layouts.app')

@section('title', 'Plant Nursery Catalog | Verdura Landscapes')

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

    @foreach(['featured' => 'Featured Picks', 'tree' => 'Trees', 'shrub' => 'Shrubs', 'groundcover' => 'Groundcovers'] as $categoryKey => $categoryTitle)
      @if(isset($plants[$categoryKey]) && $plants[$categoryKey]->count() > 0)
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
  </div>
</section>
@endsection