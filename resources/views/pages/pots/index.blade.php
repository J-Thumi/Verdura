@extends('layouts.app')

@section('title', 'Artisanal Pots Collection | Verdura Landscapes')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endpush

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Artisanal Pots</h1>
        <p class="mt-2 text-lg text-gray-600">Explore our handcrafted plant pots with multi-angle views and 3D preview.</p>
    </header>

    <!-- Search & Sort Controls Form -->
    <form action="{{ request()->url() }}" method="GET" class="mb-10">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex gap-2 w-full sm:max-w-md">
                <div class="relative flex-1">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search pots by name, material..." 
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition"
                    />
                </div>

                <button 
                    type="submit" 
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition"
                >
                    Search
                </button>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="flex items-center gap-2">
                    <label for="sort" class="text-sm font-medium text-gray-600 whitespace-nowrap">Sort by:</label>
                    <select 
                        name="sort" 
                        id="sort"
                        onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 cursor-pointer transition"
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
                        class="border border-amber-600 text-amber-700 hover:bg-amber-50 font-semibold text-sm px-4 py-2.5 rounded-xl transition whitespace-nowrap"
                    >
                        Reset Filters
                    </a>
                @endif
            </div>
        </div>
    </form>

    <!-- Pot Grid -->
    @if($pots->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($pots as $pot)
                <a 
                    href="{{ route('pots.show', $pot) }}"
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
                    class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden cursor-pointer hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block"
                >
                    <div class="relative h-72 bg-gray-100 overflow-hidden">
                        <template x-if="images.length > 0">
                            <img 
                                :src="images[currentIndex]" 
                                alt="{{ $pot->name }}" 
                                class="w-full h-full object-cover object-center transition-opacity duration-500 ease-in-out"
                            />
                        </template>
                        <template x-if="images.length === 0">
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <span>No Image Available</span>
                            </div>
                        </template>

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

                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-emerald-600 transition-colors">
                                    {{ $pot->name }}
                                </h3>
                                <p class="text-xs text-gray-500 capitalize">
                                    {{ $pot->material }} • {{ $pot->usage === 'both' ? 'Indoors and Outdoors' : $pot->usage }}
                                </p>
                            </div>
                            <span class="text-lg font-extrabold text-emerald-700">KES {{ number_format($pot->price) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $pots->links() }}
        </div>
    @else
        <div class="py-12 text-center text-gray-500">
            @if(request()->filled('search'))
                <p>No pots matching "<strong>{{ request('search') }}</strong>" found.</p>
            @else
                <p>No artisanal pots currently available in the collection.</p>
            @endif
        </div>
    @endif
</div>
@endsection