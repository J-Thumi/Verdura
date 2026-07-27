@extends('layouts.app')

@section('title', 'Verdura Landscapes | Landscape Architecture & Plant Nursery')

@section('content')
<section class="hero" id="top">
  <div class="wrap hero-inner">
    <div>
      <span class="eyebrow">Landscape Design &amp; Plant Nursery, Kenya</span>
      <h1>Landscapes built on <em>the right plant,</em><br>in the right ground.</h1>
      <p>Verdura Landscapes is run by Landscape Arch Dennis Githinji, a landscape architect supplying and planting quality landscape plants for homes, estates, and commercial grounds across Kenya.</p>
      <div class="hero-ctas">
        <a class="btn-primary" href="https://wa.me/254114936390?text=Hi%20Landscape%20Arch%20Dennis%2C%20I%27d%20like%20to%20enquire%20about%20plants%20%2F%20landscaping." target="_blank" rel="noopener">
          Chat on WhatsApp
        </a>
        <a class="btn-ghost" href="{{ route('plants.index') }}">Browse Plants</a>
      </div>
    </div>

    @if($featuredSpecimen)
    <div class="hero-tag">
      <div class="tag-photo">
        <img src="{{ asset('storage/' . $featuredSpecimen->image_url) }}" alt="{{ $featuredSpecimen->name }}">
      </div>
      <span class="tag-label">Featured Specimen</span>
      <h3>{{ $featuredSpecimen->name }}</h3>
      <span class="botanical mono">{{ $featuredSpecimen->botanical_name }}</span>
      <p>{{ $featuredSpecimen->description }}</p>
    </div>
    @endif
  </div>
</section>
@endsection