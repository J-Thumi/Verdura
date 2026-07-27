@extends('layouts.app')

@section('title', 'Completed Landscape Projects | Verdura Landscapes')

@section('content')
<section class="gallery" style="padding: 80px 0;">
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
@endsection