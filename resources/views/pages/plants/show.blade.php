@extends('layouts.app')

@section('title', $plant->name . ' | Verdura Landscapes Nursery')

@section('meta_title', $plant->name . ' (' . ($plant->botanical_name ?? 'Plant') . ') | Verdura Landscapes')
@section('meta_description', Str::limit(strip_tags($plant->description ?? 'Quality ' . $plant->name . ' available at Verdura Landscapes Nursery in Juja, Kenya.'), 150))

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endpush

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
@endpush

@push('jsonld')
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": {!! json_encode($plant->name) !!},
  "image": {!! json_encode($plant->image_url ? asset($plant->image_url) : asset('images/og-default.jpg')) !!},
  "description": {!! json_encode(strip_tags($plant->description ?? '')) !!},
  "sku": {!! json_encode('PLANT-' . $plant->id) !!},
  "offers": {
    "@type": "Offer",
    "url": {!! json_encode(route('plants.show', $plant)) !!},
    "priceCurrency": "KES",
    "price": {!! json_encode((string) $plant->price) !!},
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</script>
@endverbatim
@endpush

@section('content')
<section style="padding: 60px 0 100px;">
  <div class="wrap">
    
    <!-- Breadcrumb Nav -->
    <nav aria-label="Breadcrumb" style="margin-bottom: 32px; font-size: 0.9rem; color: #666;">
      <a href="{{ route('home') }}" style="color: var(--forest); text-decoration: none;">Home</a>
      <span style="margin: 0 8px;">/</span>
      <a href="{{ route('plants.index') }}" style="color: var(--forest); text-decoration: none;">Plants</a>
      <span style="margin: 0 8px;">/</span>
      <a href="{{ route('plants.category', $plant->category) }}" style="color: var(--forest); text-decoration: none; text-transform: capitalize;">{{ $plant->category }}s</a>
      <span style="margin: 0 8px;">/</span>
      <span style="color: var(--ink);">{{ $plant->name }}</span>
    </nav>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 48px; align-items: start;">
      
      <!-- Plant Asset/Image/3D Viewer -->
      <div style="background: var(--stone-light); border: 1px solid rgba(26,26,22,0.1); border-radius: 4px; overflow: hidden; padding: 24px; text-align: center;">
        @if(!empty($plant->model_glb_path))
          <model-viewer 
            src="{{ asset($plant->model_glb_path) }}" 
            alt="3D interactive model of {{ $plant->name }}"
            auto-rotate 
            camera-controls 
            shadow-intensity="1"
            style="width: 100%; height: 420px; background-color: transparent;"
          ></model-viewer>
        @elseif(!empty($plant->image_url))
          <img src="{{ asset($plant->image_url) }}" alt="{{ $plant->name }}" style="width: 100%; max-height: 420px; object-fit: cover; border-radius: 2px;" />
        @else
          <div style="height: 360px; display: flex; align-items: center; justify-content: center; background: #e8e6df; color: #7a7a6e;">
            <span>No Preview Available</span>
          </div>
        @endif
      </div>

      <!-- Detail Info -->
      <div>
        <span class="eyebrow" style="text-transform: uppercase;">{{ $plant->category }}</span>
        <h1 style="font-family: 'Fraunces', serif; color: var(--forest); font-size: 2.4rem; margin: 8px 0 4px;">{{ $plant->name }}</h1>
        
        @if($plant->botanical_name)
          <p style="font-style: italic; color: #55554c; font-size: 1.1rem; margin-bottom: 20px;">
            {{ $plant->botanical_name }}
          </p>
        @endif

        <div style="font-size: 1.6rem; font-weight: 700; color: var(--clay); margin-bottom: 24px;">
          KES {{ number_format($plant->price) }}
        </div>

        <div style="margin-bottom: 32px; color: var(--ink); line-height: 1.7; font-size: 1rem;">
          {!! nl2br(e($plant->description ?? 'Carefully cultivated at our Juja nursery to thrive in local conditions.')) !!}
        </div>

        <!-- Order / Inquiry CTA -->
        <a 
          href="https://wa.me/254114936390?text={{ urlencode('Hi Landscape Arch Dennis, I am interested in purchasing/enquiring about: ' . $plant->name . ' (KES ' . number_format($plant->price) . ')') }}" 
          target="_blank" 
          rel="noopener"
          style="display: inline-flex; align-items: center; gap: 10px; background: #25D366; color: #ffffff; padding: 14px 28px; font-weight: 600; font-size: 1rem; border-radius: 4px; text-decoration: none;"
        >
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.7 1.5 5.3L2 22l4.8-1.4C8.4 21.5 10.2 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.9.9-3.1-.2-.3C3.9 14.7 3.5 13.4 3.5 12c0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z"/></svg>
          Enquire on WhatsApp
        </a>
      </div>
    </div>

    <!-- Related Plants -->
    @if($relatedPlants->count() > 0)
      <div style="margin-top: 80px;">
        <h3 style="font-family: 'Fraunces', serif; color: var(--forest); margin-bottom: 24px;">Similar {{ ucfirst($plant->category) }}s</h3>
        <div class="catalog-grid">
          @foreach($relatedPlants as $related)
            <x-plant-card :plant="$related" />
          @endforeach
        </div>
      </div>
    @endif

  </div>
</section>
@endsection