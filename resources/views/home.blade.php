<!DOCTYPE html>
<html lang="id">
<head>
  <script>document.documentElement.classList.add('js');</script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perusahaan Testing Project</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/home.css', 'resources/js/app.js'])
</head>
<body x-data>

@include('partials.nav')

<!-- HERO -->
<section class="hero">
  <div class="hero-bg-circle c1"></div>
  <div class="hero-bg-circle c2"></div>
  <div class="hero-content">
    <div class="hero-badge">🇮🇩 &nbsp; Webinar Nasional Kesehatan 2025</div>
    <h1>Bersama Merawat <em>Kesehatan</em> Indonesia</h1>
    <p>Platform webinar kesehatan terpercaya yang menghadirkan narasumber dokter spesialis terkemuka, materi berbasis bukti ilmiah, dan sertifikat resmi yang diakui secara nasional.</p>
    <div class="hero-actions">
      <button class="btn-primary">Lihat Jadwal Webinar →</button>
      <button class="btn-secondary">Pelajari Lebih Lanjut</button>
    </div>
    <div class="hero-stats">
      <template x-for="(val, key) in $store.app.stats" :key="key">
        <div class="stat-item">
          <div class="stat-num" x-text="val"></div>
          <div class="stat-label" x-text="{
            participants: 'Peserta Terdaftar',
            webinars: 'Webinar Diselenggarakan',
            experts: 'Narasumber Ahli',
          }[key]"></div>
        </div>
      </template>
    </div>
  </div>
</section>

<!-- UPCOMING WEBINARS -->
<section class="section fade-section" id="webinar">
  <div class="section-header">
    <div class="section-label">Jadwal Mendatang</div>
    <h2 class="section-title">Webinar Kesehatan Pilihan</h2>
    <p class="section-sub">Pilih topik yang relevan dengan kebutuhan atau profesi Anda dan bergabung bersama ribuan peserta dari seluruh Indonesia.</p>
  </div>
  <div class="cards-grid">
    @forelse ($webinars as $w)
      <div class="webinar-card" onclick="window.location.href='{{ url('webinar/' . $w->id) }}'">
        <div class="card-top">
          <img src="{{ $w->flyer ? storage_url($w->flyer) : '' }}" alt="Flyer {{ $w->title }}">
        </div>
        <div class="card-body">
          <div class="card-tag">{{ $w->tag }}</div>
          <div class="card-title-dark">{{ $w->title }}</div>
          <div class="card-date-dark">📅 {{ $w->date ? $w->date->translatedFormat('d F Y') : '' }} · {{ $w->time }}</div>

          @if ($w->speakers)
            <div class="speaker-container">
              @foreach ($w->speakers as $s)
                <div class="card-speaker">
                  <div class="speaker-avatar">
                    <img src="{{ isset($s['avatar']) && $s['avatar'] ? storage_url($s['avatar']) : '' }}" alt="{{ $s['name'] ?? '' }}" style="object-position:{{ $s['focal'] ?? '50% 30%' }};">
                  </div>
                  <div>
                    <div class="speaker-country">{{ $s['country'] ?? '' }}</div>
                    <div class="speaker-name">{{ $s['name'] ?? '' }}</div>
                    <div class="speaker-role">{{ $s['role'] ?? '' }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          <div class="card-meta">
            <div class="meta-item">
              <strong>Platform</strong>
              <span>{{ $w->platform }}</span>
            </div>
            <div class="meta-item">
              <strong>Durasi</strong>
              <span>{{ $w->duration }}</span>
            </div>
            <div class="meta-item">
              <strong>SKP</strong>
              <span>{{ $w->skp }}</span>
            </div>
          </div>

          <div class="card-price-inline">
            <span class="price-label">Harga:</span>
            <div class="price-group">
              <span class="price-val">{{ $w->price }}</span>
              @if ($w->price2)
                <span class="price-divider">|</span>
                <span class="price-val">{{ $w->price2 }}</span>
              @endif
            </div>
          </div>

          <div class="card-actions">
            <button class="btn-details" onclick="event.stopPropagation(); window.location.href='{{ url('webinar/' . $w->id) }}'">
              Lihat Selengkapnya
            </button>
            @if ($w->register_closed)
              <button class="btn-register" style="background:#fef2f2;color:#991b1b;border-color:#fecaca;" onclick="event.stopPropagation()">
                Pendaftaran Ditutup
              </button>
            @elseif ($w->register_link && $w->register_link !== '#')
              <button class="btn-register" onclick="event.stopPropagation(); window.open('{{ $w->register_link }}')">
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
      <p style="text-align:center; color:var(--text-mid); grid-column:1/-1; padding:40px;">Belum ada webinar tersedia.</p>
    @endforelse
  </div>
</section>

<!-- FEATURED -->
<section class="section featured" id="tentang">
  <div class="featured-inner">
    <div class="featured-img">
      <div class="featured-emoji">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
      </div>
    </div>
    <div>
      <div class="section-label">Mengapa Perusahaan Testing Project?</div>
      <h2 class="section-title">Platform Edukasi Kesehatan Terpercaya di Indonesia</h2>
      <div class="featured-tags">
        <span class="tag">Bersertifikat Resmi</span>
        <span class="tag">Berbasis Bukti</span>
        <span class="tag">Terakreditasi IDI</span>
      </div>
      <p style="color:#fff; font-size:0.95rem; line-height:1.7; margin-bottom:8px;">
        Perusahaan Testing Project hadir sebagai jembatan antara profesional medis dan masyarakat umum. Kami berkomitmen menghadirkan edukasi kesehatan berkualitas tinggi yang dapat diakses oleh siapapun, di manapun di seluruh Indonesia.
      </p>
      <ul class="list-features">
        <li>Narasumber dokter spesialis berpengalaman & tersertifikasi</li>
        <li>Sertifikat elektronik yang diakui secara nasional dan SKP IDI</li>
        <li>Materi berbasis evidence-based medicine terkini</li>
        <li>Rekaman ulang tersedia yang dapat diakses pasca webinar</li>
        <li>Sesi tanya jawab interaktif langsung dengan narasumber</li>
        <li>Modul materi PDF eksklusif untuk setiap peserta</li>
      </ul>
      <button class="btn-primary" style="display:inline-block;">Mulai Belajar Sekarang →</button>
    </div>
  </div>
</section>

<!-- SPEAKERS -->
<section class="section fade-section" id="pembicara">
  <div class="section-header">
    <div class="section-label">Narasumber Unggulan</div>
    <h2 class="section-title">Belajar dari Para Ahli</h2>
    <p class="section-sub">Kami menghadirkan dokter spesialis dan tenaga kesehatan terkemuka dari berbagai rumah sakit dan institusi pendidikan terbaik di Indonesia.</p>
  </div>
  <div class="speakers-grid">
    @forelse ($speakers as $s)
      <div class="speaker-card">
        <div class="speaker-ava-big">{{ $s->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}</div>
        <div class="spk-name">{{ $s->name }}</div>
        <div class="spk-title">{{ $s->title }}</div>
        <div class="spk-inst">{{ $s->inst }}</div>
        <div class="spk-date">{{ $s->date ? $s->date->translatedFormat('d F Y') : '' }}</div>
      </div>
    @empty
      <p style="color:var(--text-mid);">Belum ada pembicara.</p>
    @endforelse
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section featured fade-section" id="testimoni" style="background:var(--green-dark) !important;color:#fff;padding:100px 60px;">
  <div class="section-header">
    <div class="section-label" style="color:#fff;">Testimoni</div>
    <h2 class="section-title" style="color:#fff !important;">Apa Kata Peserta Kami?</h2>
    <p class="section-sub" style="color:rgba(255,255,255,0.7);">Lebih dari 50.000 profesional kesehatan dan masyarakat umum telah merasakan manfaatnya.</p>
  </div>
  <div class="testimonials-grid">
    @forelse ($testimonials as $t)
      <div class="testi-card">
        <div class="testi-stars">{{ $t->stars ?? '★★★★★' }}</div>
        <p class="testi-text">{{ $t->text }}</p>
        <div class="testi-person">
          <div class="testi-ava">{{ $t->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}</div>
          <div>
            <div class="testi-name">{{ $t->name }}</div>
            <div class="testi-city">{{ $t->title }}</div>
            <div class="testi-date">{{ $t->date ? $t->date->translatedFormat('d F Y') : '' }}</div>
          </div>
        </div>
      </div>
    @empty
      <p style="color:rgba(255,255,255,0.5);">Belum ada testimoni.</p>
    @endforelse
  </div>
</section>

<!-- FAQ -->
<section class="section faq fade-section" id="faq">
  <div class="section-header">
    <div class="section-label">FAQ</div>
    <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
  </div>
  <div class="faq-list">
    <template x-for="(f, i) in $store.app.faqs" :key="i">
      <div class="faq-item" :class="{ 'open': f.open }" @click="$store.app.toggleFaq(i)">
        <div class="faq-q" x-text="f.q"></div>
        <div class="faq-a" x-show="f.open" x-transition:enter.duration.200ms x-text="f.a"></div>
      </div>
    </template>
  </div>
</section>

<!-- contact section removed -->

<!-- FOOTER -->
@include('partials.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.fade-section').forEach(el => observer.observe(el));
});
</script>

</body>
</html>
