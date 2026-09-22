<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Verdura Landscapes | Landscape Design & Plant Nursery in Kenya')</title>
    <meta name="title" content="@yield('meta_title', 'Verdura Landscapes | Landscape Design & Plant Nursery in Kenya')">
    <meta name="description" content="@yield('meta_description', 'Verdura Landscapes offers professional landscape architecture, indoor & outdoor plant sales, custom plant pots, and garden maintenance services across Juja, Nairobi, and Kenya.')">
    <meta name="keywords" content="@yield('meta_keywords', 'landscape design Kenya, plant nursery Juja, buy plants Nairobi, landscape architect Kenya, plant pots Kenya, garden design Nairobi')">
    <meta name="author" content="Verdura Landscapes">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Verdura Landscapes | Landscape Design & Plant Nursery in Kenya')">
    <meta property="og:description" content="@yield('og_description', 'Transform your outdoor spaces with expert landscape design, premium plants, and custom pots in Kenya.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:site_name" content="Verdura Landscapes">
    <meta property="og:locale" content="en_KE">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'Verdura Landscapes | Landscape Design & Plant Nursery in Kenya')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Transform your outdoor spaces with expert landscape design, premium plants, and custom pots in Kenya.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">

    <!-- Geo & Local SEO Tags -->
    <meta name="geo.region" content="KE">
    <meta name="geo.placename" content="Juja, Kenya">
    <meta name="geo.position" content="-1.1026;37.0132">
    <meta name="ICBM" content="-1.1026, 37.0132">

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Resource Hints & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Work+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:ital,wght@0,400;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')

    @verbatim
    <!-- JSON-LD Structured Data: Local Business / Garden Store -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "GardenStore",
      "name": "Verdura Landscapes",
      "image": "/images/og-default.jpg",
      "telephone": "+254114936390",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Juja",
        "addressLocality": "Juja",
        "addressRegion": "Kiambu County",
        "addressCountry": "KE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": -1.1026,
        "longitude": 37.0132
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "08:00",
        "closes": "18:00"
      },
      "sameAs": [
        "https://wa.me/254114936390"
      ]
    }
    </script>
    @endverbatim
    @stack('jsonld')
    <style>
      [x-cloak] { display: none !important; }

      .nav-dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-toggle {
        background: transparent;
        border: none;
        font: inherit;
        color: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
      }

      .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 160px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        border-radius: 6px;
        padding: 8px 0;
        z-index: 50;
      }

      .dropdown-menu a {
        display: block;
        padding: 8px 16px;
        text-decoration: none;
        color: #333;
      }

      .mobile-dropdown-toggle {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: none;
        border: none;
        font: inherit;
        padding: 8px 0;
      }

      .mobile-submenu {
        padding-left: 16px;
      }

      .rotate-180 {
        transform: rotate(180deg);
        transition: transform 0.2s ease;
      }
    </style>
</head>
<body>

<header x-data="{ open: false }">
  <nav aria-label="Main Navigation">
    <a href="{{ route('home') }}" class="brand" aria-label="Verdura Landscapes Home">
      <svg class="brand-mark" viewBox="0 0 40 40" fill="none" aria-hidden="true" role="img">
        <circle cx="20" cy="20" r="19" fill="#1F3B2C"/>
        <path d="M20 30V16" stroke="#C79A2E" stroke-width="2" stroke-linecap="round"/>
        <path d="M20 16C20 16 12 16 12 9C19 9 20 16 20 16Z" fill="#C79A2E"/>
        <path d="M20 20C20 20 28 20 28 13C21 13 20 20 20 20Z" fill="#F7F2E4"/>
      </svg>
      <span class="brand-name">Verdura <span>Landscapes</span></span>
    </a>

    <!-- Desktop Navigation Links -->
    <div class="nav-links">
      <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
      <a href="{{ route('work') }}" class="{{ request()->routeIs('work') ? 'active' : '' }}">Our Work</a>
      
      <!-- Desktop Plants Dropdown -->
      <div 
        class="nav-dropdown" 
        x-data="{ show: false }" 
        @mouseenter="show = true" 
        @mouseleave="show = false"
      >
        <button 
          class="dropdown-toggle {{ request()->is('plants*') ? 'active' : '' }}" 
          @click="show = !show"
          type="button"
          :aria-expanded="show.toString()"
          aria-haspopup="true"
        >
          Plants
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
        </button>

        <div 
          class="dropdown-menu" 
          x-show="show" 
          x-cloak
          x-transition:enter="transition ease-out duration-150"
          x-transition:enter-start="opacity-0 transform scale-95"
          x-transition:enter-end="opacity-100 transform scale-100"
          x-transition:leave="transition ease-in duration-100"
          x-transition:leave-start="opacity-100 transform scale-100"
          x-transition:leave-end="opacity-0 transform scale-95"
        >
          <a href="{{ route('plants.index') }}" class="{{ request()->routeIs('plants.index') ? 'active' : '' }}">All Plants</a>
          <a href="{{ route('plants.category', 'tree') }}" class="{{ request()->is('plants/tree') ? 'active' : '' }}">Trees</a>
          <a href="{{ route('plants.category', 'shrub') }}" class="{{ request()->is('plants/shrub') ? 'active' : '' }}">Shrubs</a>
          <a href="{{ route('plants.category', 'groundcover') }}" class="{{ request()->is('plants/groundcover') ? 'active' : '' }}">Groundcovers</a>
        </div>
      </div>

      <a href="{{ route('pots.index') }}" class="{{ request()->routeIs('pots.index') ? 'active' : '' }}">Pots</a>
      <a href="{{ route('areas') }}" class="{{ request()->routeIs('areas') ? 'active' : '' }}">Areas We Serve</a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    </div>

    <div style="display: flex; align-items: center; gap: 12px;">
      <!-- Desktop WhatsApp CTA -->
      <a class="nav-cta" href="https://wa.me/254114936390?text=Hi%20Landscape%20Arch%20Dennis%2C%20I%27d%20like%20to%20enquire%20about%20plants%20%2F%20landscaping." target="_blank" rel="noopener">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.7 1.5 5.3L2 22l4.8-1.4C8.4 21.5 10.2 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.9.9-3.1-.2-.3C3.9 14.7 3.5 13.4 3.5 12c0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z"/></svg>
        WhatsApp
      </a>

      <!-- Mobile Hamburger Toggle Button -->
      <button @click="open = !open" class="mobile-menu-btn" aria-label="Toggle Navigation Menu" :aria-expanded="open.toString()">
        <svg class="icon-menu" x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        <svg class="icon-close" x-show="open" x-cloak width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
  </nav>

  <!-- Mobile Drawer Menu -->
  <div 
    class="mobile-drawer" 
    x-show="open" 
    x-cloak 
    @click.away="open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
  >
    <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}" @click="open = false">Services</a>
    <a href="{{ route('work') }}" class="{{ request()->routeIs('work') ? 'active' : '' }}" @click="open = false">Our Work</a>
    
    <!-- Mobile Plants Accordion -->
    <div x-data="{ mobileDropdown: false }">
      <button @click="mobileDropdown = !mobileDropdown" class="mobile-dropdown-toggle" :aria-expanded="mobileDropdown.toString()">
        Plants
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :class="{ 'rotate-180': mobileDropdown }" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div x-show="mobileDropdown" class="mobile-submenu" x-cloak>
        <a href="{{ route('plants.index') }}" class="{{ request()->routeIs('plants.index') ? 'active' : '' }}" @click="open = false">All Plants</a>
        <a href="{{ route('plants.category', 'tree') }}" class="{{ request()->is('plants/tree') ? 'active' : '' }}" @click="open = false">Trees</a>
        <a href="{{ route('plants.category', 'shrub') }}" class="{{ request()->is('plants/shrub') ? 'active' : '' }}" @click="open = false">Shrubs</a>
        <a href="{{ route('plants.category', 'groundcover') }}" class="{{ request()->is('plants/groundcover') ? 'active' : '' }}" @click="open = false">Groundcovers</a>
      </div>
    </div>

    <a href="{{ route('pots.index') }}" class="{{ request()->routeIs('pots.index') ? 'active' : '' }}" @click="open = false">Pots</a> 
    <a href="{{ route('areas') }}" class="{{ request()->routeIs('areas') ? 'active' : '' }}" @click="open = false">Areas We Serve</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}" @click="open = false">About</a>
  </div>
</header>

<main role="main">
    @yield('content')
</main>

<footer>
  <div class="wrap footer-inner">
    <div>&copy; {{ date('Y') }} <strong>Verdura Landscapes</strong>. All rights reserved.</div>
    <div class="btc-badge"><span class="sym" aria-hidden="true">✦</span> Landscape Design &amp; Plant Nursery, Kenya</div>
    <span class="btc-badge"><span class="sym" aria-hidden="true">₿</span> Bitcoin accepted</span>
    <div>Juja, Kenya · <a href="tel:+254114936390">+254 114 936 390</a> · <a href="mailto:verduralandscapekenya@gmail.com">verduralandscapekenya@gmail.com</a></div>
  </div>
</footer>

<a href="https://wa.me/254114936390?text=Hi%20Landscape%20Arch%20Dennis%2C%20I%27d%20like%20to%20enquire%20about%20plants%20%2F%20landscaping." class="float-wa" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.7 1.5 5.3L2 22l4.8-1.4C8.4 21.5 10.2 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.9.9-3.1-.2-.3C3.9 14.7 3.5 13.4 3.5 12c0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z"/></svg>
</a>

@stack('scripts')
</body>
</html>