<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - Perusahaan Testing Project</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/home.css'])
  <style>
    * { box-sizing: border-box; }
    body {
      background: linear-gradient(135deg, #fdfaf5 0%, #f0f7f0 50%, #e8f5e9 100%);
      background-attachment: fixed;
      font-family: 'DM Sans', sans-serif;
      scroll-behavior: smooth;
    }
    .admin-container { min-height: 100vh; }

    /* ─── HEADER ─── */
    .admin-header {
      background: rgba(10, 46, 26, 0.85);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(255,255,255,0.08);
      padding: 16px 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
      transition: background 0.3s;
    }
    .admin-header:hover { background: rgba(10, 46, 26, 0.95); }
    .admin-header h1 { font-family: 'Playfair Display', serif; color: #fff; font-size: 1.2rem; }
    .admin-header span { color: var(--green-light, #4fd183); }
    .admin-user { display: flex; align-items: center; gap: 16px; }
    .admin-user span { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .btn-logout {
      background: transparent; color: rgba(255,255,255,0.7);
      border: 1px solid rgba(255,255,255,0.2); padding: 8px 20px;
      border-radius: 8px; font-size: 0.85rem; cursor: pointer;
      transition: all 0.25s;
    }
    .btn-logout:hover { border-color: var(--green-light); color: var(--green-light); background: rgba(79,209,131,0.08); }
    .success-msg {
      background: linear-gradient(135deg, #ecfdf5, #d1fae5);
      border: 1px solid #a7f3d0; color: #065f46;
      padding: 12px 20px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem;
      animation: slideDown 0.4s ease;
    }

    /* ─── TABS ─── */
    .admin-tabs {
      display: flex; gap: 0; border-bottom: 1px solid rgba(0,0,0,0.06);
      max-width: 1000px; margin: 0 auto; padding: 0 48px;
    }
    .admin-tab {
      padding: 14px 28px; font-size: 0.9rem; font-weight: 600;
      color: var(--text-mid); cursor: pointer; border-bottom: 2px solid transparent;
      transition: all 0.3s ease; font-family: 'DM Sans', sans-serif;
      background: none; border-top: none; border-left: none; border-right: none;
      position: relative;
    }
    .admin-tab:hover { color: var(--text-dark); background: rgba(34,160,90,0.04); }
    .admin-tab.active { color: var(--green-accent); border-bottom-color: var(--green-accent); }

    .admin-body { padding: 32px 48px; max-width: 1000px; margin: 0 auto; }
    .tab-content { display: none; animation: fadeUp 0.35s ease; }
    .tab-content.active { display: block; }

    /* ─── TABLE ─── */
    .table-wrap {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-radius: 16px;
      border: 1px solid rgba(0,0,0,0.06);
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0,0,0,0.04);
      transition: box-shadow 0.3s;
    }
    .table-wrap:hover { box-shadow: 0 8px 40px rgba(0,0,0,0.07); }
    table { width: 100%; border-collapse: collapse; }
    th {
      text-align: left; padding: 14px 16px; font-size: 0.8rem; font-weight: 600;
      color: var(--text-mid);
      background: linear-gradient(135deg, #fafaf9, #f0f7f0);
      border-bottom: 1px solid #e5e7eb;
    }
    td { padding: 12px 16px; font-size: 0.85rem; border-bottom: 1px solid #f3f4f6; color: var(--text-dark); }
    tr:last-child td { border-bottom: none; }
    tbody tr {
      transition: all 0.2s ease;
    }
    tbody tr:hover { background: rgba(34,160,90,0.03); }
    tbody tr td:first-child { border-left: 2px solid transparent; transition: border-color 0.2s; }
    tbody tr:hover td:first-child { border-left-color: var(--green-accent); }

    .badge {
      display: inline-block; padding: 3px 10px; border-radius: 20px;
      font-size: 0.75rem; font-weight: 600;
    }
    .badge-green { background: #ecfdf5; color: #065f46; }
    .badge-red { background: #fef2f2; color: #991b1b; }
    .badge-yellow { background: #fffbeb; color: #92400e; }

    /* ─── BUTTONS ─── */
    .btn-sm {
      padding: 6px 14px; border-radius: 8px; font-size: 0.8rem;
      font-weight: 600; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif;
      transition: all 0.2s ease;
    }
    .btn-sm:active { transform: scale(0.95); }
    .btn-edit { background: #eef2ff; color: #4338ca; }
    .btn-edit:hover { background: #e0e7ff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(67,56,202,0.15); }
    .btn-danger { background: #fef2f2; color: #991b1b; }
    .btn-danger:hover { background: #fee2e2; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(153,27,27,0.15); }
    .btn-add {
      background: linear-gradient(135deg, var(--green-accent), #1a8a4a);
      color: #fff; padding: 10px 20px;
      border-radius: 10px; font-size: 0.85rem; font-weight: 600; border: none;
      cursor: pointer; font-family: 'DM Sans', sans-serif; margin-bottom: 16px;
      transition: all 0.25s ease; box-shadow: 0 2px 12px rgba(34,160,90,0.2);
    }
    .btn-add:hover { background: linear-gradient(135deg, var(--green-light), var(--green-accent)); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(34,160,90,0.3); }
    .btn-add:active { transform: translateY(0) scale(0.97); }

    /* ─── MODAL ─── */
    .modal-overlay {
      position: fixed; inset: 0;
      background: rgba(0,0,0,0.4);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      display: none; align-items: center; justify-content: center; z-index: 200;
      padding: 20px;
      animation: fadeIn 0.2s ease;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
      background: rgba(255,255,255,0.98);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 20px; padding: 32px;
      width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      animation: scaleIn 0.25s ease;
    }
    .modal-box h3 { font-family: 'Playfair Display', serif; font-size: 1.3rem; margin-bottom: 20px; color: var(--text-dark); }
    .modal-close {
      float: right; background: none; border: none; font-size: 1.4rem;
      cursor: pointer; color: var(--text-mid); transition: color 0.2s, transform 0.2s;
    }
    .modal-close:hover { color: var(--text-dark); transform: rotate(90deg); }
    .form-group { margin-bottom: 14px; }
    .form-group label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-dark); margin-bottom: 4px; }
    .form-group input, .form-group textarea, .form-group select {
      width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px;
      font-size: 0.9rem; font-family: 'DM Sans', sans-serif; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
      border-color: var(--green-accent);
      box-shadow: 0 0 0 3px rgba(34,160,90,0.1);
    }
    .form-group textarea { min-height: 80px; resize: vertical; }
    .form-row { display: flex; gap: 12px; }
    .form-row .form-group { flex: 1; }
    .btn-save {
      background: linear-gradient(135deg, var(--green-accent), #1a8a4a);
      color: #fff; padding: 12px 24px;
      border-radius: 10px; font-size: 0.9rem; font-weight: 600; border: none;
      cursor: pointer; font-family: 'DM Sans', sans-serif; width: 100%; margin-top: 8px;
      transition: all 0.25s ease; box-shadow: 0 2px 12px rgba(34,160,90,0.2);
    }
    .btn-save:hover { background: linear-gradient(135deg, var(--green-light), var(--green-accent)); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(34,160,90,0.3); }
    .btn-save:active { transform: translateY(0) scale(0.97); }

    .inline-form { display: inline; }
    .empty-state { padding: 40px; text-align: center; color: var(--text-mid); font-size: 0.9rem; }

    /* ─── ANIMATIONS ─── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(12px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.92); }
      to { opacity: 1; transform: scale(1); }
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ─── ROW FADE-IN ON SCROLL ─── */
    .fade-row {
      opacity: 0;
      transform: translateY(10px);
      transition: opacity 0.45s ease, transform 0.45s ease;
    }
    .fade-row.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>
<body>

<div class="admin-container">

  <div class="admin-header">
    <h1>Perusahaan<span> Testing</span> Project</h1>
    <div class="admin-user">
      <span>{{ Auth::user()->name }}</span>
      <form method="POST" action="{{ route('auth.logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
      </form>
    </div>
  </div>

  @if (session('success'))
      <div class="success-msg">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
      <div style="background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:12px 20px;border-radius:10px;margin-bottom:20px;font-size:0.9rem;">
          <ul style="margin:0;padding-left:20px;">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="admin-tabs">
    <button class="admin-tab active" onclick="switchTab('webinar')">+ Webinar</button>
    <button class="admin-tab" onclick="switchTab('speaker')">Pembicara</button>
    <button class="admin-tab" onclick="switchTab('testimonial')">Testimoni</button>
    <button class="admin-tab" onclick="switchTab('contact')">Contact</button>
  </div>

  <div class="admin-body">

    <!-- WEBINAR TAB -->
    <div id="tab-webinar" class="tab-content active">
      <button class="btn-add" onclick="openWebinarModal()">+ Tambah Webinar Baru</button>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Judul</th>
              <th>
                <a href="{{ request()->fullUrlWithQuery(['sort_date' => $sortDate === 'desc' ? 'asc' : 'desc']) }}" style="text-decoration:none;color:inherit;display:inline-flex;align-items:center;gap:4px;">
                  Tanggal
                  @if ($sortDate === 'desc')
                    <span style="font-size:0.7rem;">&#9660;</span>
                  @else
                    <span style="font-size:0.7rem;">&#9650;</span>
                  @endif
                </a>
              </th>
              <th>Pendaftaran</th><th>LMS</th><th>Status</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($webinars as $w)
              <tr class="fade-row">
                <td style="font-weight:600;">{{ $w->title }}</td>
                <td>{{ $w->date ? $w->date->format('d M Y') : '-' }}</td>
                  <td>
                    @if ($w->register_closed || ($w->date && $w->date->isPast()))
                      <span class="badge badge-red">Ditutup</span>
                    @elseif ($w->register_link && $w->register_link !== '#')
                      <span class="badge badge-green">Terbuka</span>
                    @else
                      <span class="badge badge-yellow">Belum diatur</span>
                    @endif
                  </td>
                  <td>
                    @if ($w->lms_link)
                      <span class="badge badge-green">Ada</span>
                    @else
                      <span class="badge badge-yellow">—</span>
                    @endif
                  </td>
                <td>
                  @if ($w->is_active)
                    <span class="badge badge-green">Aktif</span>
                  @else
                    <span class="badge badge-red">Nonaktif</span>
                  @endif
                </td>
                <td>
                  <div style="display:flex; gap:6px; align-items:center;">
                    <button class="btn-sm btn-edit" onclick="openWebinarModal({{ $w->id }})">Edit</button>
                    <form class="inline-form" method="POST" action="{{ route('admin.webinar.delete', $w) }}" onsubmit="return confirm('Apa anda yakin ingin menghapus webinar ini?')">
                      @csrf
                      <button class="btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="empty-state">Belum ada webinar.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- SPEAKER TAB -->
    <div id="tab-speaker" class="tab-content">
      <button class="btn-add" onclick="openSpeakerModal()">+ Tambah Pembicara</button>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Nama</th><th>Title</th><th>Instansi</th><th>Tanggal</th><th>Aksi</th></tr></thead>
          <tbody>
            @forelse ($speakers as $s)
              <tr class="fade-row">
                <td style="font-weight:600;">{{ $s->name }}</td>
                <td>{{ $s->title }}</td>
                <td>{{ $s->inst }}</td>
                <td>{{ $s->date ? $s->date->format('d M Y') : ($s->created_at ? $s->created_at->format('d M Y') : '-') }}</td>
                <td>
                  <div style="display:flex; gap:6px; align-items:center;">
                    <button class="btn-sm btn-edit" onclick="openSpeakerModal({{ $s->id }})">Edit</button>
                    <form class="inline-form" method="POST" action="{{ route('admin.speaker.delete', $s) }}" onsubmit="return confirm('Hapus pembicara ini?')">
                      @csrf
                      <button class="btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="4" class="empty-state">Belum ada pembicara.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- TESTIMONIAL TAB -->
    <div id="tab-testimonial" class="tab-content">
      <button class="btn-add" onclick="openTestimonialModal()">+ Tambah Testimoni</button>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Nama</th><th>Title</th><th>Testimoni</th><th>Tanggal</th><th>Aksi</th></tr></thead>
          <tbody>
            @forelse ($testimonials as $t)
              <tr class="fade-row">
                <td style="font-weight:600;">{{ $t->name }}</td>
                <td>{{ $t->title }}</td>
                <td style="max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ strip_tags($t->text) }}</td>
                <td>{{ $t->date ? $t->date->format('d M Y') : ($t->created_at ? $t->created_at->format('d M Y') : '-') }}</td>
                <td>
                  <div style="display:flex; gap:6px; align-items:center;">
                    <button class="btn-sm btn-edit" onclick="openTestimonialModal({{ $t->id }})">Edit</button>
                    <form class="inline-form" method="POST" action="{{ route('admin.testimonial.delete', $t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
                      @csrf
                      <button class="btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="4" class="empty-state">Belum ada testimoni.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- CONTACT TAB -->
    <div id="tab-contact" class="tab-content">
      <div class="table-wrap" style="padding:24px;">
        <form method="POST" action="{{ route('admin.contact.update') }}">
          @csrf
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="address" rows="3">{{ $contacts['address'] ?? '' }}</textarea>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>No. Telepon</label>
              <input type="text" name="phone" value="{{ $contacts['phone'] ?? '' }}">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" value="{{ $contacts['email'] ?? '' }}">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>WhatsApp</label>
              <input type="text" name="whatsapp" value="{{ $contacts['whatsapp'] ?? '' }}" placeholder="https://wa.me/62...">
            </div>
            <div class="form-group">
              <label>Instagram</label>
              <input type="text" name="instagram" value="{{ $contacts['instagram'] ?? '' }}">
            </div>
          </div>
          <div class="form-group">
            <label>YouTube</label>
            <input type="text" name="youtube" value="{{ $contacts['youtube'] ?? '' }}">
          </div>
          <div class="form-group">
            <label>Google Maps Embed URL</label>
            <textarea name="maps_embed" rows="3" placeholder="<iframe src=... ></iframe>">{{ $contacts['maps_embed'] ?? '' }}</textarea>
          </div>
          <button class="btn-save" type="submit">Simpan Pengaturan Kontak</button>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- MODAL WEBINAR -->
<div id="webinar-modal" class="modal-overlay">
  <div class="modal-box">
    <button class="modal-close" onclick="closeWebinarModal()">&times;</button>
    <h3 id="webinar-modal-title">Tambah Webinar Baru</h3>
    <form id="webinar-form" method="POST" enctype="multipart/form-data" data-original-date="" onsubmit="document.getElementById('w-professions').value = document.getElementById('w-professions-editor').innerHTML; combineWebinarDate()">
      @csrf
      <input type="hidden" name="is_active" value="1">
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="title" id="w-title" required>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Tanggal</label>
          <input type="hidden" name="date" id="w-date">
          <div style="display:flex;gap:6px;">
            <select id="w-date-day" style="flex:1;" onchange="combineWebinarDate()">
              <option value="">Tgl</option>
              @for ($d = 1; $d <= 31; $d++)
                <option value="{{ sprintf('%02d', $d) }}">{{ $d }}</option>
              @endfor
            </select>
            <select id="w-date-month" style="flex:1;" onchange="combineWebinarDate()">
              <option value="">Bln</option>
              @foreach (['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'] as $i => $m)
                <option value="{{ sprintf('%02d', $i + 1) }}">{{ $m }}</option>
              @endforeach
            </select>
            <select id="w-date-year" style="flex:1;" onchange="combineWebinarDate()">
              <option value="">Thn</option>
              @for ($y = now()->year - 1; $y <= now()->year + 3; $y++)
                <option value="{{ $y }}">{{ $y }}</option>
              @endfor
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Waktu</label>
          <input type="text" name="time" id="w-time" value="07.30 - selesai">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Platform</label>
          <input type="text" name="platform" id="w-platform" placeholder="Zoom Webinar">
        </div>
        <div class="form-group">
          <label>Durasi</label>
          <input type="text" name="duration" id="w-duration" placeholder="4 JP / 240 menit">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Harga</label>
          <input type="text" name="price" id="w-price">
        </div>
        <div class="form-group">
          <label>Harga Kedua (opsional)</label>
          <input type="text" name="price2" id="w-price2">
        </div>
      </div>
      <div class="form-group">
        <label>Link Pendaftaran (Google Form)</label>
        <input type="text" name="register_link" id="w-register-link" placeholder="https://forms.gle/...">
      </div>
      <div class="form-group">
        <label>Link LMS Kemenkes</label>
        <input type="text" name="lms_link" id="w-lms-link" placeholder="https://lms.kemkes.go.id/...">
      </div>
      <div style="margin-bottom:14px;">
        <label style="display:flex;align-items:center;gap:6px;font-size:0.85rem;font-weight:600;color:var(--text-dark);cursor:pointer;width:fit-content;">
          <input type="checkbox" name="register_closed" id="w-register-closed" value="1" style="width:16px;height:16px;">
          Tutup Pendaftaran
        </label>
      </div>
      <div class="form-group">
        <label>Profesi</label>
        <div style="display:flex;gap:6px;margin-bottom:6px;">
          <button type="button" onclick="document.execCommand('bold')" style="padding:4px 14px;border-radius:6px;border:1px solid #d0d5dd;background:#fff;cursor:pointer;font-weight:700;font-size:0.85rem;transition:all 0.15s;" onmouseover="this.style.borderColor='var(--green-accent)'" onmouseout="this.style.borderColor='#d0d5dd'">B</button>
        </div>
        <div id="w-professions-editor" contenteditable="true" style="border:1.5px solid #e5e7eb;border-radius:8px;padding:10px 14px;min-height:80px;font-size:0.9rem;font-family:'DM Sans',sans-serif;outline:none;transition:border-color 0.2s,box-shadow 0.2s;line-height:1.6;" onfocus="this.style.borderColor='var(--green-accent)';this.style.boxShadow='0 0 0 3px rgba(34,160,90,0.1)'" onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'"></div>
        <input type="hidden" name="professions" id="w-professions">
        <small style="color:var(--text-mid);font-size:0.75rem;">Gunakan tombol <b>B</b> untuk menebalkan teks. Enter untuk baris baru.</small>
      </div>
      <div class="form-group">
        <label>SKP (range)</label>
        <input type="text" name="skp" id="w-skp" placeholder="2-8 SKP">
      </div>
      <div class="form-group">
        <label>Tag</label>
        <input type="text" name="tag" id="w-tag" placeholder="Terbaru, Populer">
      </div>
      <div class="form-group">
        <label>Flyer (upload gambar)</label>
        <input type="file" name="flyer" id="w-flyer" accept="image/*">
      </div>

      <h4 style="margin:16px 0 12px;font-size:0.95rem;">Rekening Pembayaran</h4>
      <div style="border:1px solid #e5e7eb;border-radius:10px;padding:12px;margin-bottom:12px;">
        <div class="form-row">
          <div class="form-group">
            <label>Nama Bank</label>
            <input type="text" name="bank_name" id="w-bank-name" placeholder="BCA">
          </div>
          <div class="form-group">
            <label>No. Rekening</label>
            <input type="text" name="bank_account_no" id="w-bank-account" placeholder="1234567890">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Atas Nama</label>
            <input type="text" name="bank_account_name" id="w-bank-name-holder" placeholder="PT Perusahaan Testing Project">
          </div>
        </div>
        <div class="form-group">
          <label>Logo Bank</label>
          <input type="file" name="bank_logo" id="w-bank-logo" accept="image/*" onchange="previewBankLogo(this)">
          <div id="w-bank-logo-preview" style="margin-top:6px;">
            <img id="w-bank-logo-img" style="max-width:120px;max-height:50px;object-fit:contain;display:none;">
          </div>
        </div>
      </div>

      <h4 style="margin:16px 0 12px;font-size:0.95rem;">Pemateri (maks. 3)</h4>
      @for ($i = 1; $i <= 3; $i++)
      <div style="border:1px solid #e5e7eb;border-radius:10px;padding:12px;margin-bottom:12px;">
        <div class="form-row">
          <div class="form-group">
            <label>Pemateri {{ $i }} - Nama</label>
            <input type="text" name="speaker_name_{{ $i }}" id="w-s{{ $i }}-name" placeholder="Nama pemateri {{ $i }}">
          </div>
          <div class="form-group">
            <label>Negara</label>
            <input type="text" name="speaker_country_{{ $i }}" id="w-s{{ $i }}-country" placeholder="Indonesia">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Role / Title</label>
            <input type="text" name="speaker_role_{{ $i }}" id="w-s{{ $i }}-role" placeholder="Dokter Spesialis Jantung">
          </div>
        </div>
        <div class="form-group">
          <label>Foto Pemateri {{ $i }}</label>
          <input type="file" name="speaker_avatar_{{ $i }}" id="w-s{{ $i }}-avatar" accept="image/*" onchange="previewSpeakerAvatar({{ $i }}, this)">
          <div id="w-s{{ $i }}-avatar-preview" style="position:relative;display:inline-block;margin-top:6px;cursor:crosshair;" onclick="setFocalPoint({{ $i }}, event)">
            <img id="w-s{{ $i }}-avatar-img" style="max-width:200px;max-height:200px;border-radius:10px;object-fit:cover;display:none;">
            <div id="w-s{{ $i }}-focal-dot" style="position:absolute;width:14px;height:14px;background:rgba(255,255,255,0.9);border:2px solid #059669;border-radius:50%;transform:translate(-50%,-50%);pointer-events:none;display:none;box-shadow:0 0 0 2px rgba(5,150,105,0.3);"></div>
          </div>
          <input type="hidden" name="speaker_focal_{{ $i }}" id="w-s{{ $i }}-focal" value="50% 30%">
          <small style="color:var(--text-mid);font-size:0.75rem;">Klik pada foto untuk atur pusat gambar (fokus wajah)</small>
        </div>
      </div>
      @endfor

      <h4 style="margin:16px 0 12px;font-size:0.95rem;">Pesan WhatsApp</h4>
      <div class="form-group">
        <label>Template Pesan WA (gunakan {title} untuk judul otomatis)</label>
        <textarea name="wa_message" id="w-wa-message" rows="2" placeholder="Kak saya ingin bertanya tentang webinar &quot;{title}&quot; terimakasih"></textarea>
      </div>

      <h4 style="margin:16px 0 12px;font-size:0.95rem;">Admin / Kontak</h4>
      <div class="form-row">
        <div class="form-group">
          <label>Admin Kiri - Nama</label>
          <input type="text" name="admin_left_name" id="w-admin-left-name">
        </div>
        <div class="form-group">
          <label>Admin Kiri - Nomor WA</label>
          <input type="text" name="admin_left_link" id="w-admin-left-link" placeholder="6281234567890">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Admin Kanan - Nama</label>
          <input type="text" name="admin_right_name" id="w-admin-right-name">
        </div>
        <div class="form-group">
          <label>Admin Kanan - Nomor WA</label>
          <input type="text" name="admin_right_link" id="w-admin-right-link" placeholder="6281234567890">
        </div>
      </div>

      <h4 style="margin:16px 0 12px;font-size:0.95rem;">Saluran Kesehatan</h4>
      <div class="form-group">
        <label>Teks</label>
        <textarea name="health_channel_text" id="w-health-text" rows="2" placeholder="Join Saluran Kesehatan Untuk informasi Webinar webinar berikutnya"></textarea>
      </div>
      <div class="form-group">
        <label>Link</label>
        <input type="text" name="health_channel_link" id="w-health-link">
      </div>
      <div class="form-group">
        <label>Teks Tombol</label>
        <input type="text" name="health_channel_btn_text" id="w-health-btn-text" value="Saluran Kesehatan">
      </div>

      <button class="btn-save" type="submit" id="webinar-submit-btn">Simpan</button>
    </form>
  </div>
</div>

<!-- MODAL SPEAKER -->
<div id="speaker-modal" class="modal-overlay">
  <div class="modal-box" style="max-width:460px;">
    <button class="modal-close" onclick="closeSpeakerModal()">&times;</button>
    <h3 id="speaker-modal-title">Tambah Pembicara</h3>
    <form id="speaker-form" method="POST">
      @csrf
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" id="sp-name" required>
      </div>
      <div class="form-group">
        <label>Title (spesialisasi)</label>
        <input type="text" name="title" id="sp-title" placeholder="Sp.PD-KEMD · Endokrinologi">
      </div>
      <div class="form-group">
        <label>Instansi</label>
        <input type="text" name="inst" id="sp-inst" placeholder="RSCM Jakarta">
      </div>
      <div class="form-group">
        <label>Jenis Kelamin</label>
        <div style="display:flex;gap:16px;padding-top:4px;">
          <label style="display:flex;align-items:center;gap:6px;font-size:0.85rem;cursor:pointer;">
            <input type="radio" name="gender" id="sp-gender-male" value="male" checked style="width:16px;height:16px;">
            <span style="font-size:1.3rem;">👨‍⚕️</span> Laki-laki
          </label>
          <label style="display:flex;align-items:center;gap:6px;font-size:0.85rem;cursor:pointer;">
            <input type="radio" name="gender" id="sp-gender-female" value="female" style="width:16px;height:16px;">
            <span style="font-size:1.3rem;">👩‍⚕️</span> Perempuan
          </label>
        </div>
      </div>
      <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="date" id="sp-date">
      </div>
      <button class="btn-save" type="submit">Simpan</button>
    </form>
  </div>
</div>

<!-- MODAL TESTIMONIAL -->
<div id="testimonial-modal" class="modal-overlay">
  <div class="modal-box" style="max-width:460px;">
    <button class="modal-close" onclick="closeTestimonialModal()">&times;</button>
    <h3 id="testimonial-modal-title">Tambah Testimoni</h3>
    <form id="testimonial-form" method="POST">
      @csrf
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" id="t-name" required>
      </div>
      <div class="form-group">
        <label>Title (profesi/kota)</label>
        <input type="text" name="title" id="t-title" placeholder="Dokter Umum · Makassar">
      </div>
      <div class="form-group">
        <label>Testimoni</label>
        <textarea name="text" id="t-text" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label>Rating</label>
        <div id="t-star-picker" style="display:flex;gap:4px;font-size:1.6rem;cursor:pointer;padding:4px 0;">
          <span data-star="1" onclick="setTestimonialStar(1)" style="color:#d4a853;">☆</span>
          <span data-star="2" onclick="setTestimonialStar(2)" style="color:#d4a853;">☆</span>
          <span data-star="3" onclick="setTestimonialStar(3)" style="color:#d4a853;">☆</span>
          <span data-star="4" onclick="setTestimonialStar(4)" style="color:#d4a853;">☆</span>
          <span data-star="5" onclick="setTestimonialStar(5)" style="color:#d4a853;">☆</span>
        </div>
        <input type="hidden" name="stars" id="t-stars" value="★★★★★">
      </div>
      <div class="form-group">
        <label>Jenis Kelamin</label>
        <div style="display:flex;gap:16px;padding-top:4px;">
          <label style="display:flex;align-items:center;gap:6px;font-size:0.85rem;cursor:pointer;">
            <input type="radio" name="gender" id="t-gender-male" value="male" checked style="width:16px;height:16px;">
            <span style="font-size:1.3rem;">👨‍⚕️</span> Laki-laki
          </label>
          <label style="display:flex;align-items:center;gap:6px;font-size:0.85rem;cursor:pointer;">
            <input type="radio" name="gender" id="t-gender-female" value="female" style="width:16px;height:16px;">
            <span style="font-size:1.3rem;">👩‍⚕️</span> Perempuan
          </label>
        </div>
      </div>
      <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="date" id="t-date">
      </div>
      <button class="btn-save" type="submit">Simpan</button>
    </form>
  </div>
</div>

<script>
function switchTab(name) {
  document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('.admin-tab').forEach(el => el.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  event.target.classList.add('active');
}

// ─── WEBINAR MODAL ───
const webinarData = @json($webinars);
const STORAGE_URL_BASE = '{{ storage_url_base() }}';

const WEBINAR_STORE_URL = '{{ route('admin.webinar.store') }}';

function combineWebinarDate() {
  const day = document.getElementById('w-date-day').value;
  const month = document.getElementById('w-date-month').value;
  const year = document.getElementById('w-date-year').value;
  const form = document.getElementById('webinar-form');
  if (year && month && day) {
    document.getElementById('w-date').value = year + '-' + month + '-' + day;
  } else if (form.dataset.originalDate) {
    document.getElementById('w-date').value = form.dataset.originalDate;
  } else {
    document.getElementById('w-date').value = '';
  }
}

function setWebinarDate(dateStr) {
  if (dateStr) {
    const parts = dateStr.substring(0, 10).split('-');
    document.getElementById('w-date-year').value = parts[0] || '';
    document.getElementById('w-date-month').value = parts[1] || '';
    document.getElementById('w-date-day').value = parts[2] || '';
  } else {
    document.getElementById('w-date-year').value = '';
    document.getElementById('w-date-month').value = '';
    document.getElementById('w-date-day').value = '';
  }
  combineWebinarDate();
}

function resetWebinarForm() {
  document.getElementById('webinar-form').reset();
  document.getElementById('w-register-closed').checked = false;
  for (let i = 1; i <= 3; i++) {
    document.getElementById('w-s' + i + '-name').value = '';
    document.getElementById('w-s' + i + '-role').value = '';
    document.getElementById('w-s' + i + '-country').value = '';
    document.getElementById('w-s' + i + '-focal').value = '50% 30%';
    document.getElementById('w-s' + i + '-avatar-img').style.display = 'none';
    document.getElementById('w-s' + i + '-focal-dot').style.display = 'none';
  }
  document.getElementById('w-date-day').value = '';
  document.getElementById('w-date-month').value = '';
  document.getElementById('w-date-year').value = '';
  document.getElementById('w-date').value = '';
  document.getElementById('w-professions-editor').innerHTML = '';
  document.getElementById('w-professions').value = '';
  document.getElementById('w-bank-name').value = '';
  document.getElementById('w-bank-account').value = '';
  document.getElementById('w-bank-name-holder').value = '';
  document.getElementById('w-bank-logo-img').style.display = 'none';
}

function openWebinarModal(id) {
  const modal = document.getElementById('webinar-modal');
  const form = document.getElementById('webinar-form');
  const title = document.getElementById('webinar-modal-title');
  const btn = document.getElementById('webinar-submit-btn');

  if (id) {
    const w = webinarData.find(x => x.id === id);
    if (!w) return;
    title.textContent = 'Edit Webinar';
    btn.textContent = 'Simpan Perubahan';
    form.action = '{{ url('admin/webinar') }}/' + id + '/update';
    document.getElementById('w-title').value = w.title || '';
    document.getElementById('webinar-form').dataset.originalDate = w.date || '';
    setWebinarDate(w.date || '');
    document.getElementById('w-time').value = w.time || '';
    document.getElementById('w-platform').value = w.platform || '';
    document.getElementById('w-duration').value = w.duration || '';
    document.getElementById('w-price').value = w.price || '';
    document.getElementById('w-price2').value = w.price2 || '';
    document.getElementById('w-register-link').value = w.register_link || '';
    document.getElementById('w-lms-link').value = w.lms_link || '';
    document.getElementById('w-register-closed').checked = !!w.register_closed;
    document.getElementById('w-professions-editor').innerHTML = w.professions || '';
    document.getElementById('w-professions').value = w.professions || '';
    document.getElementById('w-skp').value = w.skp || '';
    document.getElementById('w-tag').value = w.tag || '';
    document.getElementById('w-wa-message').value = w.wa_message || '';
    document.getElementById('w-admin-left-name').value = w.admin_left_name || '';
    document.getElementById('w-admin-left-link').value = w.admin_left_link || '';
    document.getElementById('w-admin-right-name').value = w.admin_right_name || '';
    document.getElementById('w-admin-right-link').value = w.admin_right_link || '';
    document.getElementById('w-bank-name').value = w.bank_name || '';
    document.getElementById('w-bank-account').value = w.bank_account_no || '';
    document.getElementById('w-bank-name-holder').value = w.bank_account_name || '';
    const bankLogoImg = document.getElementById('w-bank-logo-img');
    if (w.bank_logo) {
      bankLogoImg.src = w.bank_logo.startsWith('http') ? w.bank_logo : STORAGE_URL_BASE + w.bank_logo;
      bankLogoImg.style.display = 'block';
    } else {
      bankLogoImg.style.display = 'none';
    }
    document.getElementById('w-health-text').value = w.health_channel_text || '';
    document.getElementById('w-health-link').value = w.health_channel_link || '';
    document.getElementById('w-health-btn-text').value = w.health_channel_btn_text || '';
    // populate speakers
    const speakers = w.speakers || [];
    for (let i = 0; i < 3; i++) {
      const s = speakers[i] || {};
      const n = i + 1;
      document.getElementById('w-s' + n + '-name').value = s.name || '';
      document.getElementById('w-s' + n + '-role').value = s.role || '';
      document.getElementById('w-s' + n + '-country').value = s.country || '';
      document.getElementById('w-s' + n + '-focal').value = s.focal || '50% 30%';
      // show existing avatar if available
      const img = document.getElementById('w-s' + n + '-avatar-img');
      const dot = document.getElementById('w-s' + n + '-focal-dot');
      if (s.avatar) {
        img.src = s.avatar.startsWith('http') ? s.avatar : STORAGE_URL_BASE + s.avatar;
        img.style.display = 'block';
        const parts = (s.focal || '50% 30%').split(' ');
        applyFocalDot(n, parts[0], parts[1]);
      } else {
        img.style.display = 'none';
        dot.style.display = 'none';
      }
    }
  } else {
    title.textContent = 'Tambah Webinar Baru';
    btn.textContent = 'Simpan';
    form.action = '{{ route('admin.webinar.store') }}';
    document.getElementById('webinar-form').dataset.originalDate = '';
    resetWebinarForm();
  }
  modal.classList.add('open');
}

function closeWebinarModal() {
  document.getElementById('webinar-modal').classList.remove('open');
}

// ─── SPEAKER MODAL ───
const speakerData = @json($speakers);

function openSpeakerModal(id) {
  const modal = document.getElementById('speaker-modal');
  const form = document.getElementById('speaker-form');
  const title = document.getElementById('speaker-modal-title');
  if (id) {
    const s = speakerData.find(x => x.id === id);
    if (!s) return;
    title.textContent = 'Edit Pembicara';
    form.action = '{{ url('admin/speaker') }}/' + id + '/update';
    document.getElementById('sp-name').value = s.name;
    document.getElementById('sp-title').value = s.title;
    document.getElementById('sp-inst').value = s.inst;
    document.getElementById('sp-gender-' + (s.gender || 'male')).checked = true;
    document.getElementById('sp-date').value = s.date ? s.date.substring(0, 10) : '';
  } else {
    title.textContent = 'Tambah Pembicara';
    form.action = '{{ route('admin.speaker.store') }}';
    document.getElementById('sp-name').value = '';
    document.getElementById('sp-title').value = '';
    document.getElementById('sp-inst').value = '';
    document.getElementById('sp-gender-male').checked = true;
    document.getElementById('sp-date').value = '';
  }
  modal.classList.add('open');
}

function closeSpeakerModal() {
  document.getElementById('speaker-modal').classList.remove('open');
}

// ─── TESTIMONIAL MODAL ───
const testimonialData = @json($testimonials);

function openTestimonialModal(id) {
  const modal = document.getElementById('testimonial-modal');
  const form = document.getElementById('testimonial-form');
  const title = document.getElementById('testimonial-modal-title');
  if (id) {
    const t = testimonialData.find(x => x.id === id);
    if (!t) return;
    title.textContent = 'Edit Testimoni';
    form.action = '{{ url('admin/testimonial') }}/' + id + '/update';
    document.getElementById('t-name').value = t.name;
    document.getElementById('t-title').value = t.title;
    document.getElementById('t-text').value = t.text;
    document.getElementById('t-gender-' + (t.gender || 'male')).checked = true;
    document.getElementById('t-date').value = t.date ? t.date.substring(0, 10) : '';
    // set stars
    const starCount = (t.stars || '★★★★★').split('★').length - 1;
    setTestimonialStar(starCount || 5);
  } else {
    title.textContent = 'Tambah Testimoni';
    form.action = '{{ route('admin.testimonial.store') }}';
    document.getElementById('t-name').value = '';
    document.getElementById('t-title').value = '';
    document.getElementById('t-text').value = '';
    document.getElementById('t-gender-male').checked = true;
    document.getElementById('t-date').value = '';
    setTestimonialStar(5);
  }
  modal.classList.add('open');
}

const STAR_FULL = '★';
const STAR_EMPTY = '☆';

function setTestimonialStar(count) {
  const hidden = document.getElementById('t-stars');
  const spans = document.querySelectorAll('#t-star-picker span');
  let full = '';
  for (let i = 0; i < 5; i++) {
    if (i < count) {
      spans[i].textContent = STAR_FULL;
      full += STAR_FULL;
    } else {
      spans[i].textContent = STAR_EMPTY;
    }
  }
  hidden.value = full;
}

function closeTestimonialModal() {
  document.getElementById('testimonial-modal').classList.remove('open');
}

// Click outside modal to close
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });
});

// ─── BANK LOGO PREVIEW ───
function previewBankLogo(input) {
  const img = document.getElementById('w-bank-logo-img');
  const file = input.files[0];
  if (!file) { img.style.display = 'none'; return; }
  const reader = new FileReader();
  reader.onload = function(e) {
    img.src = e.target.result;
    img.style.display = 'block';
  };
  reader.readAsDataURL(file);
}

// ─── SPEAKER AVATAR PREVIEW + FOCAL POINT ───
function previewSpeakerAvatar(i, input) {
  const img = document.getElementById('w-s' + i + '-avatar-img');
  const dot = document.getElementById('w-s' + i + '-focal-dot');
  const focal = document.getElementById('w-s' + i + '-focal');
  const file = input.files[0];
  if (!file) { img.style.display = 'none'; dot.style.display = 'none'; return; }
  const reader = new FileReader();
  reader.onload = function(e) {
    img.src = e.target.result;
    img.style.display = 'block';
    img.style.objectFit = 'cover';
    // reset focal to default
    focal.value = '50% 30%';
    applyFocalDot(i, '50%', '30%');
  };
  reader.readAsDataURL(file);
}

function setFocalPoint(i, event) {
  const img = document.getElementById('w-s' + i + '-avatar-img');
  const rect = img.getBoundingClientRect();
  const xPct = ((event.clientX - rect.left) / rect.width * 100).toFixed(1);
  const yPct = ((event.clientY - rect.top) / rect.height * 100).toFixed(1);
  document.getElementById('w-s' + i + '-focal').value = xPct + '% ' + yPct + '%';
  applyFocalDot(i, xPct + '%', yPct + '%');
}

function applyFocalDot(i, x, y) {
  const dot = document.getElementById('w-s' + i + '-focal-dot');
  dot.style.display = 'block';
  dot.style.left = x;
  dot.style.top = y;
}

// ─── FADE ROWS ON SCROLL ───
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.fade-row').forEach(el => observer.observe(el));
</script>

</body>
</html>
