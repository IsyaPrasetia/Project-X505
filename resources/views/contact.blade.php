<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak - Perusahaan Testing Project</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/home.css', 'resources/js/app.js'])
  <style>
    .contact-page {
      min-height: 100vh;
      background: linear-gradient(135deg, #fdfaf5 0%, #f0f7f0 50%, #e8f5e9 100%);
      background-attachment: fixed;
    }

    .contact-hero {
      background: linear-gradient(135deg, var(--green-dark) 0%, #0d3a22 50%, #145c30 100%);
      padding: 160px 60px 80px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .contact-hero::before {
      content: '';
      position: absolute;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(79,209,131,0.08) 0%, transparent 70%);
      top: -150px; right: -100px;
      border-radius: 50%;
    }
    .contact-hero::after {
      content: '';
      position: absolute;
      width: 300px; height: 300px;
      background: radial-gradient(circle, rgba(212,168,83,0.06) 0%, transparent 70%);
      bottom: -80px; left: -80px;
      border-radius: 50%;
    }
    .contact-hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.6rem; color: #fff;
      margin-bottom: 12px; position: relative;
      opacity: 0; animation: fadeUp 0.7s ease 0.1s forwards;
    }
    .contact-hero h1 span { color: var(--green-light); }
    .contact-hero p {
      color: rgba(255,255,255,0.65);
      font-size: 1.05rem; max-width: 500px; margin: 0 auto;
      position: relative;
      opacity: 0; animation: fadeUp 0.7s ease 0.2s forwards;
    }
    .contact-hero .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(34,160,90,0.18);
      border: 1px solid rgba(79,209,131,0.3);
      color: var(--green-light); padding: 6px 16px; border-radius: 50px;
      font-size: 0.78rem; font-weight: 600; letter-spacing: 1.5px;
      text-transform: uppercase; margin-bottom: 24px;
      opacity: 0; animation: fadeUp 0.7s ease forwards;
    }

    .contact-body {
      max-width: 900px; margin: -40px auto 0;
      padding: 0 24px 80px;
      position: relative; z-index: 2;
    }

    .contact-card {
      background: rgba(255,255,255,0.92);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 24px;
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 8px 48px rgba(0,0,0,0.06);
      padding: 48px;
      opacity: 0; animation: fadeUp 0.7s ease 0.3s forwards;
    }
    .contact-card:hover { box-shadow: 0 12px 60px rgba(0,0,0,0.08); }

    .contact-grid {
      display: grid; grid-template-columns: 1fr 1fr; gap: 40px;
    }

    .contact-info-item { margin-bottom: 28px; }
    .contact-info-item:last-child { margin-bottom: 0; }
    .contact-info-item .label {
      font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
      letter-spacing: 1.5px; color: var(--green-accent);
      margin-bottom: 2px;
    }
    .contact-info-item .value {
      font-size: 0.95rem; color: var(--text-dark);
      line-height: 1.6;
    }
    .contact-info-item .value a {
      color: var(--green-accent); text-decoration: none;
      transition: color 0.2s;
    }
    .contact-info-item .value a:hover { color: var(--green-light); }

    .sosmed-group {
      display: flex; flex-wrap: wrap; gap: 10px; margin-top: 4px;
    }
    .sosmed-link {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 20px; border-radius: 50px;
      background: rgba(34,160,90,0.07);
      border: 1px solid rgba(34,160,90,0.12);
      font-size: 0.85rem; font-weight: 600; color: var(--text-dark);
      text-decoration: none; transition: all 0.25s;
    }
    .sosmed-link:hover {
      background: var(--green-accent);
      border-color: var(--green-accent);
      color: #fff; transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(34,160,90,0.25);
    }

    .map-wrap {
      border-radius: 16px; overflow: hidden;
      border: 1px solid rgba(0,0,0,0.05);
      min-height: 280px;
      transition: box-shadow 0.3s;
    }
    .map-wrap:hover { box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
    .map-placeholder {
      background: linear-gradient(135deg, #e5e7eb, #d1d5db);
      height: 280px; display: flex;
      align-items: center; justify-content: center;
      color: var(--text-mid); font-size: 0.9rem;
    }

    .contact-divider {
      width: 40px; height: 3px;
      background: linear-gradient(90deg, var(--green-accent), var(--green-light));
      border-radius: 2px; margin: 0 auto 20px;
    }

    .back-link {
      display: inline-flex; align-items: center; gap: 6px;
      margin-top: 32px; color: var(--text-mid);
      text-decoration: none; font-size: 0.9rem;
      transition: color 0.2s, transform 0.2s;
    }
    .back-link:hover { color: var(--green-accent); transform: translateX(-4px); }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 640px) {
      .contact-hero { padding: 140px 24px 60px; }
      .contact-hero h1 { font-size: 1.8rem; }
      .contact-card { padding: 28px; }
      .contact-grid { grid-template-columns: 1fr; gap: 28px; }
    }
  </style>
</head>
<body>

<div class="contact-page">

@include('partials.nav')

<section class="contact-hero">
  <div class="hero-badge">✉️ &nbsp; Hubungi Kami</div>
  <h1>Mari <span>Terhubung</span></h1>
  <p>Punya pertanyaan, saran, atau ingin kerja sama? Tim kami siap membantu Anda.</p>
</section>

<div class="contact-body">
  <div class="contact-card">
    <div class="contact-grid">
      <div>
        <div class="contact-info-item">
          <div class="label">Alamat</div>
          <div class="value">{{ $contacts['address'] ?? 'Indonesia' }}</div>
        </div>
        <div class="contact-info-item">
          <div class="label">Telepon</div>
          <div class="value">{{ $contacts['phone'] ?? '-' }}</div>
        </div>
        <div class="contact-info-item">
          <div class="label">Email</div>
          <div class="value">{{ $contacts['email'] ?? '-' }}</div>
        </div>
        <div class="contact-info-item">
          <div class="label">Media Sosial</div>
          <div class="sosmed-group">
            @if (!empty($contacts['whatsapp'])) <a href="{{ $contacts['whatsapp'] }}" target="_blank" class="sosmed-link">💬 WhatsApp</a> @endif
            @if (!empty($contacts['instagram'])) <a href="{{ $contacts['instagram'] }}" target="_blank" class="sosmed-link">📸 Instagram</a> @endif
            @if (!empty($contacts['youtube'])) <a href="{{ $contacts['youtube'] }}" target="_blank" class="sosmed-link">▶ YouTube</a> @endif
          </div>
        </div>
      </div>
      <div class="map-wrap">
        @if (!empty($contacts['maps_embed']))
          {!! $contacts['maps_embed'] !!}
        @else
          <div class="map-placeholder">📍 Peta belum diatur</div>
        @endif
      </div>
    </div>
  </div>

  <a href="{{ url('/') }}" class="back-link">← Kembali ke Beranda</a>
</div>

<footer>
  <div class="footer-grid">
@include('partials.footer')

</div>

</body>
</html>
