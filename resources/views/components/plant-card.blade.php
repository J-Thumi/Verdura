@props(['plant'])

<div class="plant-tag">
  <a href="{{ route('plants.show', $plant) }}" style="color: inherit; text-decoration: none;">
  <div class="plant-photo">
    <img src="{{ $plant->image_url ?? 'https://via.placeholder.com/400x300?text=Plant+Photo' }}" alt="{{ $plant->name }}">
  </div>
   <h3>

  </h3>
  <h3>{{ $plant->name }}</h3>
  @if($plant->botanical_name)
    <span class="botanical mono">{{ $plant->botanical_name }}</span>
  @endif
  <p class="desc">{{ Str::limit($plant->description, 90) }}</p>
  <div class="price">KES {{ number_format($plant->price, 2) }}</div>
  <a class="order-btn" href="https://wa.me/254114936390?text=Hi%20Dennis%2C%20I%27d%20like%20to%20order%20the%20{{ urlencode($plant->name) }}." target="_blank" rel="noopener">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.7-.8-1.9-.9-.3-.1-.4-.1-.6.1-.2.3-.7.9-.8 1-.2.2-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.2-.4.1-.2 0-.3 0-.5-.1-.1-.6-1.5-.9-2-.2-.5-.5-.4-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.3-.1-.2-.3-.2-.5-.3z"/></svg>
    Order on WhatsApp
  </a>
</a>
</div>