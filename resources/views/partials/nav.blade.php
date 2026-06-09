<nav>
  <div class="nav-logo">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="window.location.href='{{ url('/') }}'" />
  </div>
  <ul class="nav-links">
    <li><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{ url('/webinars') }}">Webinar</a></li>
    <li><a href="{{ url('/contact') }}">Kontak</a></li>
  </ul>
  <a href="{{ url('login') }}"><button class="nav-cta">Login Admin</button></a>
</nav>
