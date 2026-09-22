@extends('layouts.app')

@section('title', $pot->name . ' | Artisanal Pots | Verdura Landscapes')
@section('meta_title', $pot->name . ' - Handcrafted Plant Pot | Verdura Landscapes')
@section('meta_description', Str::limit(strip_tags($pot->description ?? 'Quality handcrafted plant pot available at Verdura Landscapes in Kenya.'), 150))

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endpush

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @if($pot->model_3d_path)
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>
    @endif
@endpush

@push('jsonld')
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": {!! json_encode($pot->name) !!},
  "image": {!! json_encode($pot->images->first() ? asset('storage/' . $pot->images->first()->image_path) : asset('images/og-default.jpg')) !!},
  "description": {!! json_encode(strip_tags($pot->description ?? '')) !!},
  "sku": {!! json_encode('POT-' . $pot->id) !!},
  "offers": {
    "@type": "Offer",
    "url": {!! json_encode(route('pots.show', $pot)) !!},
    "priceCurrency": "KES",
    "price": {!! json_encode((string) $pot->price) !!},
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</script>
@endverbatim
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Breadcrumb -->
    <nav class="mb-8 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-emerald-600 transition">Home</a>
        <span>/</span>
        <a href="{{ route('pots.index') }}" class="hover:text-emerald-600 transition">Artisanal Pots</a>
        <span>/</span>
        <span class="text-gray-900 font-medium">{{ $pot->name }}</span>
    </nav>

    <div 
        x-data="{ 
            images: {{ json_encode($pot->images->pluck('image_path')->map(fn($path) => asset('storage/' . $path))) }},
            currentIndex: 0,
            activeView: 'gallery',
            nextImage() {
                if (this.images.length > 0) {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                }
            },
            prevImage() {
                if (this.images.length > 0) {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                }
            }
        }"
        class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start"
    >
        
        <!-- Left Column: Image Carousel / 3D Viewer -->
        <div class="space-y-4">
            
            <!-- View Selector Tabs (if 3D model exists) -->
            @if($pot->model_3d_path)
                <div class="flex space-x-2">
                    <button 
                        @click="activeView = 'gallery'" 
                        :class="activeView === 'gallery' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition"
                    >
                        Multi-Angle Gallery
                    </button>
                    <button 
                        @click="activeView = '3d'" 
                        :class="activeView === '3d' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-1.5"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        3D Interactive Model
                    </button>
                </div>
            @endif

            <!-- Main Interactive Image Display -->
            <div x-show="activeView === 'gallery'" class="relative h-[440px] sm:h-[500px] bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 shadow-sm group">
                <template x-if="images.length > 0">
                    <img 
                        :src="images[currentIndex]" 
                        alt="{{ $pot->name }}" 
                        class="w-full h-full object-cover object-center transition-all duration-300"
                    />
                </template>
                <template x-if="images.length === 0">
                    <div class="w-full h-full flex items-center justify-center text-gray-400 font-medium">
                        <span>No Images Available</span>
                    </div>
                </template>

                <!-- Next & Previous Navigation Arrows on Image -->
                <template x-if="images.length > 1">
                    <div>
                        <!-- Previous Arrow -->
                        <button 
                            @click="prevImage()" 
                            class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2.5 rounded-full backdrop-blur-md transition transform -translate-x-2 group-hover:translate-x-0 opacity-80 group-hover:opacity-100"
                            aria-label="Previous Image"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>

                        <!-- Next Arrow -->
                        <button 
                            @click="nextImage()" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2.5 rounded-full backdrop-blur-md transition transform translate-x-2 group-hover:translate-x-0 opacity-80 group-hover:opacity-100"
                            aria-label="Next Image"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>

                        <!-- Angle Counter Indicator -->
                        <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md text-white text-xs px-3 py-1.5 rounded-full font-medium">
                            <span x-text="(currentIndex + 1) + ' / ' + images.length + ' Angles'"></span>
                        </div>
                    </div>
                </template>
            </div>

            <!-- 3D Interactive Model Viewer -->
            @if($pot->model_3d_path)
                <div x-show="activeView === '3d'" class="h-[440px] sm:h-[500px] bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 relative" x-cloak>
                    <model-viewer 
                        src="{{ asset('storage/' . $pot->model_3d_path) }}" 
                        alt="3D interactive view of {{ $pot->name }}" 
                        auto-rotate 
                        camera-controls 
                        shadow-intensity="1"
                        class="w-full h-full"
                    ></model-viewer>
                </div>
            @endif

            <!-- Thumbnail Selector List -->
            <template x-if="images.length > 1 && activeView === 'gallery'">
                <div class="flex gap-3 overflow-x-auto pb-2">
                    <template x-for="(img, idx) in images" :key="idx">
                        <button 
                            @click="currentIndex = idx"
                            :class="currentIndex === idx ? 'ring-2 ring-emerald-600 border-transparent' : 'border-gray-200 opacity-70 hover:opacity-100'"
                            class="w-20 h-20 rounded-xl overflow-hidden border flex-shrink-0 transition-all duration-200"
                        >
                            <img :src="img" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </template>
        </div>

        <!-- Right Column: Specs & Direct Inquiry CTA -->
        <div class="space-y-6">
            <div>
                <span class="text-xs font-bold tracking-wider text-emerald-700 uppercase bg-emerald-50 px-3 py-1 rounded-full">
                    Artisanal Pot
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-3 tracking-tight">
                    {{ $pot->name }}
                </h1>
                <p class="text-2xl font-extrabold text-emerald-700 mt-2">
                    KES {{ number_format($pot->price) }}
                </p>
            </div>

            <!-- Description -->
            <p class="text-gray-600 leading-relaxed text-base">
                {{ $pot->description ?? 'Handcrafted by skilled artisans and treated for maximum outdoor durability and interior beauty.' }}
            </p>

            <!-- Product Specs Table -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 space-y-3">
                <h3 class="font-bold text-gray-900 text-sm tracking-wide uppercase mb-2">Specifications</h3>
                <div class="grid grid-cols-2 gap-y-3 text-sm">
                    <div><span class="text-gray-500">Material:</span> <strong class="text-gray-900 capitalize">{{ $pot->material }}</strong></div>
                    <div><span class="text-gray-500">Finish:</span> <strong class="text-gray-900 capitalize">{{ $pot->finish ?? 'N/A' }}</strong></div>
                    <div><span class="text-gray-500">Height:</span> <strong class="text-gray-900">{{ $pot->height_cm ? $pot->height_cm . ' cm' : 'N/A' }}</strong></div>
                    <div><span class="text-gray-500">Diameter:</span> <strong class="text-gray-900">{{ $pot->diameter_cm ? $pot->diameter_cm . ' cm' : 'N/A' }}</strong></div>
                    <div><span class="text-gray-500">Drainage Hole:</span> <strong class="text-gray-900">{{ $pot->has_drainage_holes ? 'Yes' : 'No' }}</strong></div>
                    <div>
                        <span class="text-gray-500">Usage:</span> 
                        <strong class="text-gray-900 capitalize">
                            {{ $pot->usage === 'both' ? 'Indoors & Outdoors' : $pot->usage }}
                        </strong>
                    </div>
                </div>
            </div>

            <!-- Inquiry CTA Button -->
            <a 
                href="https://wa.me/254114936390?text={{ urlencode('Hi Dennis, I would like to inquire about purchasing the ' . $pot->name . ' (KES ' . number_format($pot->price) . ').') }}"
                target="_blank"
                rel="noopener"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-lg px-8 py-4 rounded-xl shadow-lg hover:shadow-emerald-200 transition-all duration-200 flex items-center justify-center gap-3"
            >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.7 1.5 5.3L2 22l4.8-1.4C8.4 21.5 10.2 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.9.9-3.1-.2-.3C3.9 14.7 3.5 13.4 3.5 12c0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z"/></svg>
                Inquire on WhatsApp
            </a>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedPots->count() > 0)
        <div class="mt-20 border-t border-gray-100 pt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">More Artisanal Pots</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach($relatedPots as $related)
                    <a href="{{ route('pots.show', $related) }}" class="group block bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gray-100 overflow-hidden">
                            @if($related->images->first())
                                <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>
                        <div class="p-4 flex justify-between items-center">
                            <h3 class="font-bold text-gray-900 group-hover:text-emerald-600 transition">{{ $related->name }}</h3>
                            <span class="text-sm font-extrabold text-emerald-700">KES {{ number_format($related->price) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection