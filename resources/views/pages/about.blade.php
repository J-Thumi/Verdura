@extends('layouts.app')

@section('title', 'About Us & Our Team | Verdura Landscapes')
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
<!-- Hero Section -->
<section style="padding: 80px 0 40px; background: var(--paper);">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Who We Are</span>
        <h2>Transforming Outdoor Spaces Across Kenya</h2>
      </div>
      <p style="max-width: 680px;">
        Verdura Landscapes is a full-service landscape architectural and contracting firm. We craft complete outdoor environments—combining vibrant living flora with durable hardscape structures like cabro paving, stone retaining walls, and outdoor living features.
      </p>
    </div>
  </div>
</section>

<!-- What We Do Grid -->
<section style="padding: 40px 0 80px; background: var(--paper);">
  <div class="wrap">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
      
      <!-- Living Landscapes -->
      <div style="background: var(--stone-light); padding: 32px; border: 1px solid rgba(26,26,22,0.1); border-radius: 4px;">
        <div style="width: 48px; height: 48px; background: rgba(31,59,44,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--forest)" stroke-width="2"><path d="M12 2a10 10 0 0 1 10 10c0 5.523-4.477 10-10 10S2 17.523 2 12A10 10 0 0 1 12 2z"/><path d="M12 6v12M8 10l4-4 4 4"/></svg>
        </div>
        <h3 style="color: var(--forest); margin-bottom: 12px; font-family: 'Fraunces', serif;">Softscaping & Plants</h3>
        <p style="color: #55554c; line-height: 1.6;">
          From instant lawn installation (Arabic, Zimbabwe grass) to mature canopy trees, flowering shrubs, and customized irrigation systems designed for tropical climates.
        </p>
      </div>

      <!-- Hardscaping & Cabro -->
      <div style="background: var(--stone-light); padding: 32px; border: 1px solid rgba(26,26,22,0.1); border-radius: 4px;">
        <div style="width: 48px; height: 48px; background: rgba(199,154,46,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--clay)" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        </div>
        <h3 style="color: var(--forest); margin-bottom: 12px; font-family: 'Fraunces', serif;">Hardscaping & Cabro Works</h3>
        <p style="color: #55554c; line-height: 1.6;">
          Heavy-duty driveways, walkways, interlocking cabro paving blocks, kerbstones, outdoor drainage channels, natural stone cladding, and boundary retaining walls.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- Team Section -->
<section style="padding: 80px 0; background: var(--stone-light); border-top: 1px solid rgba(26,26,22,0.08);">
  <div class="wrap">
    <div class="section-head" style="margin-bottom: 48px;">
      <div>
        <span class="eyebrow">Our Experts</span>
        <h2>Meet The Team Behind Verdura</h2>
      </div>
      <p>A dedicated team of landscape architects, horticulturists, and skilled paving craftsmen.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 32px;">
      @foreach($teamMembers as $member)
        <div style="background: var(--paper); border: 1px solid rgba(26,26,22,0.1); border-radius: 4px; overflow: hidden; display: flex; flex-direction: column;">
          <img 
            src="{{ $member->image_url ? Storage::url($member->image_url) : 'https://placehold.co/400x400/1F3B2C/F7F2E4?text=' . urlencode($member->name) }}" 
            alt="{{ $member->name }}"
            style="width: 100%; height: 280px; object-fit: cover;"
            onerror="this.onerror=null; this.src='https://placehold.co/400x400/1F3B2C/F7F2E4?text=Team+Member';"
          />
          <div style="padding: 24px; flex: 1; display: flex; flex-direction: column;">
            <h3 style="margin: 0 0 4px; font-size: 1.25rem; color: var(--ink); font-family: 'Fraunces', serif;">
              {{ $member->name }}
            </h3>
            <p style="color: var(--clay); font-weight: 600; font-size: 0.88rem; margin-bottom: 8px;">
              {{ $member->role }}
            </p>
            
            @if($member->specialty)
              <span style="display: inline-block; background: rgba(31,59,44,0.08); color: var(--forest); font-size: 0.78rem; font-weight: 600; padding: 4px 8px; border-radius: 2px; margin-bottom: 12px; width: fit-content;">
                {{ $member->specialty }}
              </span>
            @endif

            <p style="color: #55554c; font-size: 0.9rem; line-height: 1.5; margin-bottom: 16px; flex: 1;">
              {{ $member->bio }}
            </p>

            @if($member->phone)
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}" target="_blank" rel="noopener" style="color: var(--forest); font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                Contact {{ strtok($member->name, ' ') }} on WhatsApp &rarr;
              </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection