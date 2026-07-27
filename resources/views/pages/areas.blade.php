@extends('layouts.app')

@section('title', 'Areas We Serve | Verdura Landscapes')
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
<section class="areas" style="padding: 80px 0;">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Coverage</span>
        <h2>Areas We Serve</h2>
      </div>
      <p>Delivering quality plants and landscape architecture services across major towns and residential hubs in Kenya.</p>
    </div>
    <div style="display: flex; gap: 16px; flex-wrap: wrap; margin-top: 24px;">
      <div class="area-chip">Nairobi &amp; Kiambu</div>
      <div class="area-chip">Ruiru &amp; Thika</div>
      <div class="area-chip">Karen &amp; Runda</div>
      <div class="area-chip">Nakuru &amp; Naivasha</div>
      <div class="area-chip">Mombasa &amp; Coastal Region</div>
    </div>
  </div>
</section>
@endsection