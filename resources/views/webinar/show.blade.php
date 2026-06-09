<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $webinar->title }} - Perusahaan Testing Project</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/home.css', 'resources/js/app.js'])
</head>
<body x-data>

@php
  $isPast = $webinar->isPast();
@endphp

@include('partials.nav')

<section class="section" style="padding-top: 140px;">
  <div style="max-width: 720px; margin: 0 auto;">

    <h1 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; font-weight: 900; margin-bottom: 24px; color: var(--text-dark);">
      {{ $webinar->title }}
    </h1>

    <div style="margin-bottom: 28px; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
      <img src="{{ $webinar->flyer ? storage_url($webinar->flyer) : '' }}" alt="{{ $webinar->title }}" style="width: 100%; height: auto; display: block;">
    </div>

    @if ($isPast || $webinar->register_closed)
      <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 12px 20px; border-radius: 12px; margin-bottom: 16px; font-weight: 600; text-align: center;">
        Pendaftaran Ditutup ❌
      </div>
    @endif

    <div style="font-size: 1.05rem; color: var(--text-mid); margin-bottom: 28px;">
      📅 {{ $webinar->date->translatedFormat('l, d F Y') }} · {{ $webinar->time }}
    </div>

    @php
      $isClosed = $isPast || $webinar->register_closed;
    @endphp

    @if ($isClosed)
      <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 12px 20px; border-radius: 12px; margin-bottom: 28px; font-weight: 500;">
        Pendaftaran Ditutup ❌
      </div>
    @elseif ($webinar->register_link && $webinar->register_link !== '#')
      <div style="display:flex;gap:12px;margin-bottom:28px;">
        <a href="{{ $webinar->register_link }}" target="_blank" rel="noopener" style="display: inline-block; background: var(--green-accent); color: #fff; padding: 14px 36px; border-radius: 50px; font-weight: 600; text-decoration: none; box-shadow: 0 8px 32px rgba(34,160,90,0.35); transition: all 0.2s;" onmouseover="this.style.background='var(--green-light)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='var(--green-accent)'; this.style.transform='none'">
          📝 Daftar Sekarang
        </a>
        @if ($webinar->lms_link)
          <a href="{{ $webinar->lms_link }}" target="_blank" rel="noopener" style="display: inline-block; background: #1d4ed8; color: #fff; padding: 14px 36px; border-radius: 50px; font-weight: 600; text-decoration: none; box-shadow: 0 8px 32px rgba(29,78,216,0.35); transition: all 0.2s;" onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1d4ed8'; this.style.transform='none'">
            🎓 LMS KEMENKES
          </a>
        @endif
      </div>
    @elseif ($webinar->lms_link)
      <div style="display:flex;gap:12px;margin-bottom:28px;">
        <a href="{{ $webinar->lms_link }}" target="_blank" rel="noopener" style="display: inline-block; background: #1d4ed8; color: #fff; padding: 14px 36px; border-radius: 50px; font-weight: 600; text-decoration: none; box-shadow: 0 8px 32px rgba(29,78,216,0.35); transition: all 0.2s;" onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1d4ed8'; this.style.transform='none'">
          🎓 LMS KEMENKES
        </a>
      </div>
    @else
      <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 12px 20px; border-radius: 12px; margin-bottom: 28px; font-weight: 500;">
        Pendaftaran akan segera dibuka
      </div>
    @endif

    <div style="margin-bottom: 28px;">
      <span style="font-size: 0.85rem; color: var(--text-mid);">Biaya Daftar:</span>
      <div style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 800; color: var(--green-accent);">
        {{ $webinar->price }}
        @if ($webinar->price2)
          <span style="color: #ccc; font-weight: 300;">|</span>
          <span style="color: var(--green-accent);">{{ $webinar->price2 }}</span>
        @endif
      </div>
    </div>

    @if ($webinar->professions)
      <div style="margin-bottom: 28px;">
        <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 6px;">Profesi yang bisa mengikuti:</span>
        <div style="color: var(--text-mid); line-height: 1.8;">
          {!! $webinar->professions !!}
        </div>
      </div>
    @endif

    @if ($webinar->bank_name || $webinar->bank_account_no)
      <div style="margin-bottom: 28px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 16px; padding: 20px 24px;">
        <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 12px;">Rekening Pembayaran</span>
        <div style="display: flex; align-items: center; gap: 16px;">
          @if ($webinar->bank_logo)
            <img src="{{ storage_url($webinar->bank_logo) }}" alt="{{ $webinar->bank_name }}" style="max-width:100px;max-height:40px;object-fit:contain;">
          @endif
          <div>
            @if ($webinar->bank_name)
              <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-dark);">{{ $webinar->bank_name }}</div>
            @endif
            @if ($webinar->bank_account_no)
              <div style="font-size: 1rem; font-weight: 800; color: var(--green-accent); letter-spacing: 1px; margin: 2px 0;">{{ $webinar->bank_account_no }}</div>
            @endif
            @if ($webinar->bank_account_name)
              <div style="font-size: 0.8rem; color: var(--text-mid);">a.n. {{ $webinar->bank_account_name }}</div>
            @endif
          </div>
        </div>
      </div>
    @endif

    @php
      $defaultMsg = 'Kak saya ingin bertanya tentang webinar "' . $webinar->title . '" terimakasih';
      $template = $webinar->wa_message ?: 'Kak saya ingin bertanya tentang webinar "{title}" terimakasih';
      $waMsg = rawurlencode(str_replace('{title}', $webinar->title, $template));

      function waLink($input, $msg) {
        if (!$input) return '#';
        $input = trim($input);
        if (str_starts_with($input, 'http')) {
          return str_contains($input, '?') ? $input . '&text=' . $msg : $input . '?text=' . $msg;
        }
        return 'https://wa.me/' . ltrim($input, '+') . '?text=' . $msg;
      }
    @endphp

    <div style="margin-bottom: 12px; font-size: 0.9rem; color: var(--text-mid);">
      Pertanyaan lebih lanjut bisa menghubungi:
    </div>

    <div style="display: flex; gap: 16px; margin-bottom: 32px;">
      @if ($webinar->admin_left_name)
        <a href="{{ waLink($webinar->admin_left_link, $waMsg) }}" target="_blank" rel="noopener"
           style="flex: 1; padding: 14px 20px; border-radius: 12px; font-weight: 600; font-size: 0.9rem; text-align: center; text-decoration: none;
                  background: #fff; color: var(--text-dark); border: 1.5px solid var(--green-accent); transition: all 0.2s;"
           onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='#fff'">
          {{ $webinar->admin_left_name }}
        </a>
      @endif
      @if ($webinar->admin_right_name)
        <a href="{{ waLink($webinar->admin_right_link, $waMsg) }}" target="_blank" rel="noopener"
           style="flex: 1; padding: 14px 20px; border-radius: 12px; font-weight: 600; font-size: 0.9rem; text-align: center; text-decoration: none;
                  background: var(--green-accent); color: #fff; transition: all 0.2s;"
           onmouseover="this.style.background='var(--green-light)'" onmouseout="this.style.background='var(--green-accent)'">
          {{ $webinar->admin_right_name }}
        </a>
      @endif
    </div>

    @if ($webinar->health_channel_text || $webinar->health_channel_link)
      <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 16px; padding: 24px; margin-bottom: 28px;">
        <p style="color: var(--text-mid); font-size: 0.92rem; line-height: 1.7; margin-bottom: 16px;">
          {{ $webinar->health_channel_text ?: 'Join Saluran Kesehatan Untuk informasi Webinar webinar berikutnya' }}
        </p>
        @if ($webinar->health_channel_link)
          <a href="{{ $webinar->health_channel_link }}" target="_blank" rel="noopener"
             style="display: inline-block; background: var(--green-accent); color: #fff; padding: 12px 28px; border-radius: 50px; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: background 0.2s;"
             onmouseover="this.style.background='var(--green-light)'" onmouseout="this.style.background='var(--green-accent)'">
            🔗 {{ $webinar->health_channel_btn_text ?: 'Saluran Kesehatan' }}
          </a>
        @endif
      </div>
    @endif

    @if ($isPast)
      <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 16px 20px; border-radius: 12px; font-weight: 600; text-align: center;">
        Pendaftaran Ditutup ❌
      </div>
    @endif

  </div>
</section>

@include('partials.footer')

</body>
</html>
