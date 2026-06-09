<!DOCTYPE html>
<html lang="id">
<head>
  <script>document.documentElement.classList.add('js');</script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Webinar - Perusahaan Testing Project</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/home.css', 'resources/js/app.js'])
</head>
<body>

@include('partials.nav')

<section class="section" style="padding-top:120px;">
  <div class="section-header">
    <div class="section-label">Seluruh Jadwal</div>
    <h2 class="section-title">Webinar Kesehatan</h2>
    <p class="section-sub">Seluruh webinar kesehatan yang akan datang. Pilih topik yang sesuai dengan kebutuhan Anda.</p>
  </div>

  <div class="wlist">
    @forelse ($webinars as $w)
      <div class="wlist-card" onclick="window.location.href='{{ url('webinar/' . $w->id) }}'">
        <div class="wlist-flyer">
          <img src="{{ $w->flyer ? storage_url($w->flyer) : '' }}" alt="Flyer {{ $w->title }}">
        </div>
        <div class="wlist-body">
          <div class="wlist-tag">{{ $w->tag }}</div>
          <div class="wlist-title">{{ $w->title }}</div>
          <div class="wlist-date">📅 {{ $w->date ? $w->date->translatedFormat('d F Y') : '' }} · {{ $w->time }}</div>

          @if ($w->speakers)
            <div class="wlist-speakers">
              @foreach ($w->speakers as $s)
                <div class="wlist-speaker">
                  <div class="wlist-s-ava">
                    <img src="{{ isset($s['avatar']) && $s['avatar'] ? storage_url($s['avatar']) : '' }}" alt="{{ $s['name'] ?? '' }}" style="object-position:{{ $s['focal'] ?? '50% 30%' }};">
                  </div>
                  <div>
                    <div class="wlist-s-country">{{ $s['country'] ?? '' }}</div>
                    <div class="wlist-s-name">{{ $s['name'] ?? '' }}</div>
                    <div class="wlist-s-role">{{ $s['role'] ?? '' }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
        <div class="wlist-meta">
          <div class="wlist-m-item">
            <strong>Platform</strong>
            <span>{{ $w->platform }}</span>
          </div>
          <div class="wlist-m-item">
            <strong>Durasi</strong>
            <span>{{ $w->duration }}</span>
          </div>
          <div class="wlist-m-item">
            <strong>SKP</strong>
            <span>{{ $w->skp }}</span>
          </div>
          <div class="wlist-price">
            <span class="price-label">Harga:</span>
            <span class="price-val">{{ $w->price }}</span>
            @if ($w->price2)
              <span class="price-divider">|</span>
              <span class="price-val">{{ $w->price2 }}</span>
            @endif
          </div>
          <div class="wlist-actions">
            <button class="btn-details" onclick="event.stopPropagation();window.location.href='{{ url('webinar/' . $w->id) }}'">
              Lihat Selengkapnya
            </button>
            @if ($w->register_closed)
              <button class="btn-register" style="background:#fef2f2;color:#991b1b;border-color:#fecaca;" onclick="event.stopPropagation()">
                Pendaftaran Ditutup
              </button>
            @elseif ($w->register_link && $w->register_link !== '#')
              <button class="btn-register" onclick="event.stopPropagation();window.open('{{ $w->register_link }}')">
                Daftar Sekarang
              </button>
            @else
              <button class="btn-register" onclick="event.stopPropagation()">
                Daftar Sekarang
              </button>
            @endif
          </div>
        </div>
      </div>
    @empty
      <p style="text-align:center;color:var(--text-mid);padding:60px 0;grid-column:1/-1;">
        Belum ada webinar tersedia.
      </p>
    @endforelse
  </div>
</section>

@include('partials.footer')


</html>
