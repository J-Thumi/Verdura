@extends('layouts.app')

@section('title', 'Our Services | Verdura Landscapes')
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
<section class="services" style="padding: 80px 0;">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">What we do</span>
        <h2>From bare ground to finished garden</h2>
      </div>
      <p>Every project starts with the site: soil, sun, and how the space will actually be used.</p>
    </div>
    <div class="service-grid">
      <div class="service-card">
        <span class="num">01</span>
        <h3>Landscape Design</h3>
        <p>Site plans, BOQs, cost estimates, schematic design, planting layouts, irrigation, lighting and hardscape design for homes, offices, and commercial developments.</p>
      </div>
      <div class="service-card">
        <span class="num">02</span>
        <h3>Plant Supply &amp; Delivery</h3>
        <p>Trees, hedges, flowering shrubs, and groundcover sourced and delivered to your site anywhere in Kenya.</p>
      </div>
      <div class="service-card">
        <span class="num">03</span>
        <h3>Installation &amp; Maintenance</h3>
        <p>Planting, irrigation setup, working schedule and ongoing garden care to keep landscapes healthy long after handover.</p>
      </div>
    </div>
  </div>
</section>
@endsection