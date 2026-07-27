<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Verdura Landscapes: Landscape Design & Plant Nursery, Kenya')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,500&family=Work+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:ital,wght@0,400;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

<header x-data="{ open: false }">
  <nav>
    <a href="{{ route('home') }}" class="brand">
      <svg class="brand-mark" viewBox="0 0 40 40" fill="none">
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
      <a href="{{ route('plants.index') }}" class="{{ request()->routeIs('plants.index') ? 'active' : '' }}">All Plants</a>
      <a href="{{ route('plants.category', 'tree') }}" class="{{ request()->is('plants/tree') ? 'active' : '' }}">Trees</a>
      <a href="{{ route('plants.category', 'shrub') }}" class="{{ request()->is('plants/shrub') ? 'active' : '' }}">Shrubs</a>
      <a href="{{ route('plants.category', 'groundcover') }}" class="{{ request()->is('plants/groundcover') ? 'active' : '' }}">Groundcovers</a>
      <a href="{{ route('pots') }}" class="{{ request()->routeIs('pots') ? 'active' : '' }}">Pots</a>
      <a href="{{ route('areas') }}" class="{{ request()->routeIs('areas') ? 'active' : '' }}">Areas We Serve</a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    </div>

    <div style="display: flex; align-items: center; gap: 12px;">
      <!-- Desktop WhatsApp CTA -->
      <a class="nav-cta" href="https://wa.me/254114936390?text=Hi%20Landscape%20Arch%20Dennis%2C%20I%27d%20like%20to%20enquire%20about%20plants%20%2F%20landscaping." target="_blank" rel="noopener">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.7 1.5 5.3L2 22l4.8-1.4C8.4 21.5 10.2 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.9.9-3.1-.2-.3C3.9 14.7 3.5 13.4 3.5 12c0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z"/></svg>
        WhatsApp
      </a>

      <!-- Mobile Hamburger Toggle Button -->
      <button @click="open = !open" class="mobile-menu-btn" aria-label="Toggle Menu">
        <svg class="icon-menu" x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        <svg class="icon-close" x-show="open" x-cloak width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
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
    <a href="{{ route('plants.index') }}" class="{{ request()->routeIs('plants.index') ? 'active' : '' }}" @click="open = false">All Plants</a>
    <a href="{{ route('plants.category', 'tree') }}" class="{{ request()->is('plants/tree') ? 'active' : '' }}" @click="open = false">Trees</a>
    <a href="{{ route('plants.category', 'shrub') }}" class="{{ request()->is('plants/shrub') ? 'active' : '' }}" @click="open = false">Shrubs</a>
    <a href="{{ route('plants.category', 'groundcover') }}" class="{{ request()->is('plants/groundcover') ? 'active' : '' }}" @click="open = false">Groundcovers</a>
    <a href="{{ route('pots') }}" class="{{ request()->routeIs('pots') ? 'active' : '' }}" @click="open = false">Pots</a>
    <a href="{{ route('areas') }}" class="{{ request()->routeIs('areas') ? 'active' : '' }}" @click="open = false">Areas We Serve</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}" @click="open = false">About</a>
  </div>
</header>

<main>
    @yield('content')
</main>

<footer>
  <div class="wrap footer-inner">
    <div>&copy; {{ date('Y') }} <strong>Verdura Landscapes</strong>. All rights reserved.</div>
    <div class="btc-badge"><span class="sym">✦</span> Landscape Design &amp; Plant Nursery, Kenya</div>
    <span class="btc-badge"><span class="sym">₿</span> Bitcoin accepted</span>
    <div>Juja, Kenya · +254 114 936 390 · <a href="mailto:verduralandscapekenya@gmail.com">verduralandscapekenya@gmail.com</a></div>
  </div>
</footer>

<a href="https://wa.me/254114936390?text=Hi%20Landscape%20Arch%20Dennis%2C%20I%27d%20like%20to%20enquire%20about%20plants%20%2F%20landscaping." class="float-wa" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.7 1.5 5.3L2 22l4.8-1.4C8.4 21.5 10.2 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.9.9-3.1-.2-.3C3.9 14.7 3.5 13.4 3.5 12c0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z"/></svg>
</a>

@stack('scripts')
</body>
</html>