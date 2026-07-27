@extends('layouts.app') {{-- Adjust layout path if needed (e.g. layouts.master or app) --}}

@section('title', 'Artisanal Pots Collection | Verdura Landscapes')

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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ selectedPot: null }">
    <header class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Artisanal Pots</h1>
        <p class="mt-2 text-lg text-gray-600">Explore our collection with live multi-angle views and 3D preview.</p>
    </header>

    <!-- Pot Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($pots as $pot)
            <div 
                x-data="{ 
                    images: {{ json_encode($pot->images->pluck('image_path')->map(fn($path) => asset('storage/' . $path))) }},
                    currentIndex: 0,
                    timer: null,
                    startRotation() {
                        if (this.images.length > 1) {
                            this.timer = setInterval(() => {
                                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                            }, 2200);
                        }
                    },
                    stopRotation() {
                        if (this.timer) clearInterval(this.timer);
                    }
                }"
                x-init="startRotation()"
                @mouseenter="stopRotation()"
                @mouseleave="startRotation()"
                @click="selectedPot = {{ json_encode($pot->load('images')) }}"
                class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden cursor-pointer hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
            >
                <!-- Auto-rotating Multi-Angle Image Container -->
                <div class="relative h-72 bg-gray-100 overflow-hidden">
                    <template x-if="images.length > 0">
                        <img 
                            :src="images[currentIndex]" 
                            :alt="'{{ $pot->name }}'" 
                            class="w-full h-full object-cover object-center transition-opacity duration-500 ease-in-out"
                        />
                    </template>
                    <template x-if="images.length === 0">
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <span>No Image Available</span>
                        </div>
                    </template>

                    <!-- Angle Badge Indicator -->
                    <div class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md text-white text-xs px-2.5 py-1 rounded-full font-medium">
                        <span x-text="images.length > 0 ? (currentIndex + 1) + '/' + images.length + ' Angles' : 'No preview'"></span>
                    </div>

                    @if($pot->model_3d_path)
                        <div class="absolute top-3 right-3 bg-emerald-600 text-white text-xs px-2.5 py-1 rounded-full font-semibold shadow-md flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            3D View
                        </div>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-emerald-600 transition-colors">
                                {{ $pot->name }}
                            </h3>
                            <p class="text-xs text-gray-500 capitalize">{{ $pot->material }} • {{ $pot->usage }}</p>
                        </div>
                        <span class="text-lg font-extrabold text-emerald-700">KES {{ number_format($pot->price, 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Detail Modal -->
    <div 
        x-show="selectedPot" 
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    >
        <div 
            @click.away="selectedPot = null" 
            class="bg-white rounded-2xl max-w-4xl w-full overflow-hidden shadow-2xl transform transition-all"
        >
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900" x-text="selectedPot?.name"></h2>
                <button @click="selectedPot = null" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8" x-data="{ activeTab: 'gallery' }">
                <!-- Media Showcase Section -->
                <div>
                    <!-- Toggle Tab for 3D vs Multi-Angle Gallery -->
                    <div class="flex space-x-2 mb-4" x-show="selectedPot?.model_3d_path">
                        <button 
                            @click="activeTab = 'gallery'" 
                            :class="activeTab === 'gallery' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition"
                        >
                            Multi-Angle Gallery
                        </button>
                        <button 
                            @click="activeTab = '3d'" 
                            :class="activeTab === '3d' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition flex items-center gap-1"
                        >
                            3D Interactive View
                        </button>
                    </div>

                    <!-- Gallery Tab -->
                    <div x-show="activeTab === 'gallery'">
                        <div class="h-80 bg-gray-100 rounded-xl overflow-hidden mb-3">
                            <template x-if="selectedPot?.images && selectedPot.images.length > 0">
                                <img :src="'/storage/' + selectedPot.images[0].image_path" class="w-full h-full object-cover">
                            </template>
                        </div>
                    </div>

                    <!-- 3D Model View Tab -->
                    <div x-show="activeTab === '3d'" class="h-80 bg-gray-100 rounded-xl overflow-hidden relative">
                        <template x-if="selectedPot?.model_3d_path">
                            <model-viewer 
                                :src="'/storage/' + selectedPot.model_3d_path" 
                                alt="3D model of pot" 
                                auto-rotate 
                                camera-controls 
                                shadow-intensity="1"
                                class="w-full h-full"
                            ></model-viewer>
                        </template>
                    </div>
                </div>

                <!-- Specifications Section -->
                <div class="space-y-4">
                    <p class="text-gray-600 text-sm leading-relaxed" x-text="selectedPot?.description"></p>

                    <div class="border-t border-b border-gray-100 py-4 grid grid-cols-2 gap-y-3 text-sm">
                        <div><span class="text-gray-400">Material:</span> <strong x-text="selectedPot?.material"></strong></div>
                        <div><span class="text-gray-400">Finish:</span> <strong x-text="selectedPot?.finish || 'N/A'"></strong></div>
                        <div><span class="text-gray-400">Height:</span> <strong x-text="selectedPot?.height_cm ? selectedPot.height_cm + ' cm' : 'N/A'"></strong></div>
                        <div><span class="text-gray-400">Diameter:</span> <strong x-text="selectedPot?.diameter_cm ? selectedPot.diameter_cm + ' cm' : 'N/A'"></strong></div>
                        <div><span class="text-gray-400">Drainage Holes:</span> <strong x-text="selectedPot?.has_drainage_holes ? 'Yes' : 'No'"></strong></div>
                        <div>
                        <div>
                            <span class="text-gray-400">Usage:</span>

                            <strong
                                class="capitalize"
                                x-text="selectedPot?.usage === 'both'
                                    ? 'Indoors and Outdoors'
                                    : selectedPot?.usage">
                            </strong>
                        </div>

                    
                    </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-3xl font-extrabold text-emerald-700" x-text="'KES ' + Number(selectedPot?.price || 0).toLocaleString()"></span>
                        <a 
                            :href="'https://wa.me/254114936390?text=' + encodeURIComponent('Hi Dennis, I would like to inquire about purchasing the ' + selectedPot?.name + '.')"
                            target="_blank"
                            rel="noopener"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-6 py-2.5 rounded-xl transition flex items-center gap-2"
                        >
                            Inquire on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection