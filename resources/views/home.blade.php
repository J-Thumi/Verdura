@extends('layouts.app')

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
        <a class="btn-ghost" href="#catalog">Browse Plants</a>
      </div>
    </div>

    @if($featuredSpecimen)
    <div class="hero-tag">
      <div class="tag-photo">
        <img src="{{ $featuredSpecimen->image_url }}" alt="{{ $featuredSpecimen->name }}">
      </div>
      <span class="tag-label">Featured Specimen</span>
      <h3>{{ $featuredSpecimen->name }}</h3>
      <span class="botanical mono">{{ $featuredSpecimen->botanical_name }}</span>
      <p>{{ $featuredSpecimen->description }}</p>
    </div>
    @endif
  </div>
</section>

<section class="services" id="services">
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

<section class="gallery" id="work">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Recently completed</span>
        <h2>From plan to finished garden</h2>
      </div>
      <p>A residential compound we took from schematic design through to planting and lighting installation.</p>
    </div>
    <div class="gallery-grid">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1558904541-efa843a96f01?auto=format&fit=crop&w=800&q=80" alt="Completed Garden Project">
        <div class="cap">
          <span class="tag">Residential Landscape</span>
          <h4>Private Compound Landscaping</h4>
        </div>
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=800&q=80" alt="Plant Installation">
        <div class="cap">
          <span class="tag">Plant Installation</span>
          <h4>Botanical Layout &amp; Softscaping</h4>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DYNAMIC CATALOG SECTION -->
<section id="catalog">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Nursery Catalog</span>
        <h2>Our Plants &amp; Trees</h2>
      </div>
      <p>Quality landscape plants cultivated and selected for Kenya’s climate conditions.</p>
    </div>

    @foreach(['tree' => 'Trees', 'shrub' => 'Shrubs', 'groundcover' => 'Groundcovers'] as $categoryKey => $categoryTitle)
      @if(isset($plants[$categoryKey]) && $plants[$categoryKey]->count() > 0)
        <div id="{{ $categoryKey }}s" style="margin-bottom: 50px;">
          <h3 style="font-size: 1.5rem; color: var(--forest); margin-bottom: 24px; font-family: 'Fraunces', serif;">
            {{ $categoryTitle }}
          </h3>
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

<section class="areas" id="areas">
  <div class="wrap">
    <div class="section-head">
      <div>
        <span class="eyebrow">Coverage</span>
        <h2>Areas We Serve</h2>
      </div>
      <p>Delivering quality plants and landscape architecture services across major towns and residential hubs in Kenya.</p>
    </div>
    <div class="area-chip">Nairobi &amp; Kiambu</div>
    <div class="area-chip">Ruiru &amp; Thika</div>
    <div class="area-chip">Karen &amp; Runda</div>
    <div class="area-chip">Nakuru &amp; Naivasha</div>
    <div class="area-chip">Mombasa &amp; Coastal Region</div>
  </div>
</section>
@endsection