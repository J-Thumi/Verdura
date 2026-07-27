@extends('layouts.app')

@section('title', 'Completed Landscape Projects | Verdura Landscapes')
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
<section class="gallery" style="padding: 80px 0;">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Recently completed</span>
        <h2>From plan to finished garden</h2>
      </div>
      <p>Explore our recent landscape architecture, softscaping, and cabro paving projects across Kenya.</p>
    </div>

    @if($projects->count() > 0)
      <div class="gallery-grid">
        @foreach($projects as $project)
          <div class="gallery-item">
            <img 
              src="{{ $project->cover_image_url }}" 
              alt="{{ $project->title }}"
              onerror="this.onerror=null; this.src='https://placehold.co/800x600/1F3B2C/F7F2E4?text=Project+Photo';"
            >
            <div class="cap">
              <span class="tag">{{ $project->category }}</span>
              <h4>{{ $project->title }}</h4>
              @if($project->location)
                <small style="color: rgba(255,255,255,0.8); display: block; margin-top: 4px;">
                  📍 {{ $project->location }}
                </small>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div style="padding: 40px 0; text-align: center; color: #55554c;">
        <p>No project showcase entries added yet.</p>
      </div>
    @endif
  </div>
</section>
@endsection